package config;

import java.sql.*;
import java.util.ArrayList;

import modele.Ingredient;
import modele.Pizza;

public class BD {

	public static Connection openConnection() {
		Connection co = null;
		//String url = "jdbc:mysql://192.70.36.54/saes3-sgvoka?user=saes3-sgvoka&password=eCijzwOcTxcw7l1M&zeroDateTimeBehavior=convertToNull";
		String url = "jdbc:mysql://127.0.0.1:3306/saes3-sgvoka?user=root&password=";

		try {
			Class.forName("com.mysql.cj.jdbc.Driver");
			co = DriverManager.getConnection(url);
		} catch (ClassNotFoundException e) {
			System.out.println("Il manque le driver");
			System.exit(1);
		} catch (SQLException e) {
			System.out.println("Impossible de se connecter à l'url : " + url);
			System.exit(1);
		}
		return co;
	}

	public static ResultSet exec1(String requete, Connection co) {
		ResultSet res = null;
		try {
			Statement st;
			st = co.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);

			res = st.executeQuery(requete);
		} catch (SQLException e) {
			System.out.println("P");
		}
		return res;
	}
	
	public static void execUpdate(String q, Connection co) {
	    try {
	        Statement st;
	        st = co.createStatement();

	        st.executeUpdate(q);
	    } catch (SQLException e) {
	        e.printStackTrace();
	    }
	}


	public static void printPizza(ResultSet rset, int nbRows) {
		try {
			while (rset.next() && nbRows > 0) {
				int numPizza = rset.getInt(1);
				String nom = rset.getString(2);
				double prix = rset.getDouble(3);
				System.out.println(numPizza + "  " + nom + "  " + prix);
				nbRows--;
			}
		} catch (SQLException e) {

		}
	}

	public static ArrayList<Pizza> getPizzaAttente(Connection co) throws SQLException {
		// faire requete sur la vue -> get id pizza
		String q = "SELECT Id_Pizza, PA.Id_Commande, nom_pizza, heure_paiement FROM PizzaAttente PA NATURAL JOIN Pizza NATURAL JOIN paiement p WHERE PA.Id_Commande = p.Id_Commande";
		ResultSet res = BD.exec1(q, co);
		ArrayList<Integer> ids = new ArrayList<Integer>();
		ArrayList<Integer> cmd = new ArrayList<Integer>();
		ArrayList<String> noms = new ArrayList<String>();
		ArrayList<Time> heures = new ArrayList<Time>();
		while (res.next()) {
			ids.add(res.getInt(1));
			cmd.add(res.getInt(2));
			noms.add(res.getString(3));
			heures.add(res.getTime(4));
		}
		// get ingredients des pizzas
		ArrayList<ArrayList<Ingredient>> ingrs = new ArrayList<ArrayList<Ingredient>>();
		for (int i = 0; i < ids.size(); i++) {
			q = "SELECT c.Id_Ingredient, nom_Ingredient FROM contient c INNER JOIN Ingredient I ON c.Id_Ingredient = I.Id_Ingredient WHERE Id_Pizza = "
					+ ids.get(i) + ";";
			res = BD.exec1(q, co);
			ArrayList<Ingredient> ingr = new ArrayList<Ingredient>();
			while (res.next()) {
				if (res.getInt(1) == 15) {
					continue;
				}
				Ingredient ing = new Ingredient(res.getInt(1), res.getString(2));
				ingr.add(ing);
			}
			ingrs.add(ingr);
		}

		// get qts
		ArrayList<ArrayList<Double>> quantites = new ArrayList<ArrayList<Double>>();
		for (int i = 0; i < ids.size(); i++) {
			ArrayList<Double> qt = new ArrayList<Double>();
			for (int j = 0; j < ingrs.get(i).size(); j++) {
				q = "SELECT quantité FROM contient c WHERE c.Id_Pizza = " + ids.get(i) + " AND Id_Ingredient = "
						+ ingrs.get(i).get(j).getId() + " ;";
				res = BD.exec1(q, co);
				while (res.next()) {
					qt.add(res.getDouble(1));
				}
			}
			quantites.add(qt);
		}

		// build les pizzas
		ArrayList<Pizza> pizzas = new ArrayList<Pizza>();
		for (int i = 0; i < ids.size(); i++) {
			int id = ids.get(i);
			int idcmd = cmd.get(i);
			String nom = noms.get(i);

			pizzas.add(new Pizza(id, idcmd, nom, ingrs.get(i), quantites.get(i), heures.get(i), false));
		}

		return pizzas;
	}

	public static ArrayList<Pizza> getPizzaPersoAttente(Connection co) throws SQLException {
		// faire requete sur la vue -> get id pizza
		String q = "SELECT Id_pizza_perso, Id_Commande, heure_paiement FROM PizzaPersoAttente PA NATURAL JOIN Pizza_perso NATURAL JOIN paiement p WHERE PA.Id_Commande = p.Id_Commande";
		ResultSet res = BD.exec1(q, co);
		ArrayList<Integer> ids = new ArrayList<Integer>();
		ArrayList<Integer> cmd = new ArrayList<Integer>();
		ArrayList<String> noms = new ArrayList<String>();
		ArrayList<Time> heures = new ArrayList<Time>();
		int cpt = 1;
		while (res.next()) {
			ids.add(res.getInt(1));
			cmd.add(res.getInt(2));
			noms.add("Pizza perso " + cpt);
			heures.add(res.getTime(3));
			cpt++;
		}
		// get ingredients des pizzas
		ArrayList<ArrayList<Ingredient>> ingrs = new ArrayList<ArrayList<Ingredient>>();
		for (int i = 0; i < ids.size(); i++) {
			q = "SELECT c.Id_Ingredient, nom_Ingredient FROM contient_perso c INNER JOIN Ingredient I ON c.Id_Ingredient = I.Id_Ingredient WHERE Id_pizza_perso = "
					+ ids.get(i) + ";";
			res = BD.exec1(q, co);
			ArrayList<Ingredient> ingr = new ArrayList<Ingredient>();
			while (res.next()) {
				if (res.getInt(1) == 15) {
					continue;
				}
				Ingredient ing = new Ingredient(res.getInt(1), res.getString(2));
				ingr.add(ing);
			}
			ingrs.add(ingr);
		}

		// get qts
		ArrayList<ArrayList<Double>> quantites = new ArrayList<ArrayList<Double>>();
		for (int i = 0; i < ids.size(); i++) {
			ArrayList<Double> qt = new ArrayList<Double>();
			for (int j = 0; j < ingrs.get(i).size(); j++) {
				q = "SELECT quantité_perso FROM contient_perso c WHERE c.Id_pizza_perso = " + ids.get(i)
						+ " AND Id_Ingredient = " + ingrs.get(i).get(j).getId() + " ;";
				res = BD.exec1(q, co);
				while (res.next()) {
					qt.add(res.getDouble(1));
				}
			}
			quantites.add(qt);
		}

		// build les pizzas
		ArrayList<Pizza> pizzas = new ArrayList<Pizza>();
		for (int i = 0; i < ids.size(); i++) {
			int id = ids.get(i);
			int idcmd = cmd.get(i);
			String nom = noms.get(i);

			pizzas.add(new Pizza(id, idcmd, nom, ingrs.get(i), quantites.get(i), heures.get(i), true));
		}

		return pizzas;
	}

	public static ArrayList<Pizza> getAllPizzas(Connection co) throws SQLException{
		
		ArrayList<Pizza> pizzas = BD.getPizzaAttente(co);
		ArrayList<Pizza> pizzasperso = BD.getPizzaPersoAttente(co);
		
		for (int i = 0; i < pizzasperso.size(); i++) {
			pizzas.add(pizzasperso.get(i));
		}
		
		// trier par ordre d'heure de la commande
		Pizza.trierHeure(pizzas);
		return pizzas;
	}
	
	
	public static void setPizzaPrete(Pizza pizza) throws SQLException {
		Connection co = openConnection();
		if (!pizza.isPerso()) {
			String q = "UPDATE est_dans SET pret = 1 WHERE Id_Commande = " + pizza.getIdCmd() + " AND Id_Pizza = " + pizza.getId() + ";";
			System.out.println("SQL Query: " + q);
			BD.execUpdate(q, co);
		} else {
			String q = "UPDATE est_dans_v2 SET pret = 1 WHERE Id_Commande = " + pizza.getIdCmd() + " AND Id_pizza_perso = " + pizza.getId() + ";";
			System.out.println("SQL Query: " + q);
			BD.execUpdate(q, co);
		}		
		co.close();
	}


	

}
