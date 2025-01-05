package modele;

import java.sql.Time;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;

public class Pizza {

	private int id;
	private int idCmd;
	private String nom;
	private ArrayList<Ingredient> ingredients;
	private ArrayList<Double> quantites;
	private boolean prete;
	private Time heurePaiement;
	private boolean estPerso;
	
	
	public Pizza (int id, int idCmd, String nom, ArrayList<Ingredient> ingr, ArrayList<Double> qt, Time heure, boolean perso) {
		this.id = id;
		this.idCmd = idCmd;
		this.nom = nom;
		ingredients = ingr;
		quantites = qt;
		prete = false;
		heurePaiement = heure;
		estPerso = perso;
	}
	
	public static void trierHeure(ArrayList<Pizza> pizzas){
		Collections.sort(pizzas, Comparator.comparing(Pizza::getIdCmd));
	}
	
	public Time getHeurePaiement() {
        return heurePaiement;
    }
	
	public int getId() {
		return id;
	}
	
	public void setId(int id) {
		this.id = id;
	}
	
	public int getIdCmd() {
		return idCmd;
	}
	
	public void setIdCmd(int id) {
		this.idCmd = id;
	}

	public String getNom() {
		return nom;
	}

	public void setNom(String nom) {
		this.nom = nom;
	}

	public ArrayList<Ingredient> getIngredients() {
		return ingredients;
	}
	
	public void setIngredients(ArrayList<Ingredient> ingredients) {
		this.ingredients = ingredients;
	}

	public ArrayList<Double> getQuantites() {
		return quantites;
	}

	public void setQuantites(ArrayList<Double> quantites) {
		this.quantites = quantites;
	}

	public boolean isPrete() {
		return prete;
	}

	public void setPrete(boolean prete) {
		this.prete = prete;
	}

	public boolean isPerso() {
		return estPerso;
	}

	public void setEstPerso(boolean estPerso) {
		this.estPerso = estPerso;
	}

	public void setHeurePaiement(Time heurePaiement) {
		this.heurePaiement = heurePaiement;
	}

}
