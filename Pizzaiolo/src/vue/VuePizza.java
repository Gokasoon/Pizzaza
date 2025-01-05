package vue;

import java.awt.*;
import java.util.*;

import javax.swing.*;
import modele.*;

public class VuePizza extends JPanel {

	private Pizza modele;
	private JLabel lblPizzaIngr;
	private JLabel lblPizzaNom;
	
	public VuePizza(Pizza pizza) {
		modele = pizza;
		String s = "";
		String nom = pizza.getNom() + " : ";
		for(int i = 0; i < pizza.getIngredients().size(); i++) {
			if ( i != 0)
			{
				s += " - ";
			}
			s += pizza.getIngredients().get(i).getNom() + " " + pizza.getQuantites().get(i) + "kg ";
		}
		
		lblPizzaNom = new JLabel(nom);
		lblPizzaNom.setFont(new Font("Arial", Font.BOLD, 25));
		lblPizzaNom.setForeground(Color.RED);
		lblPizzaIngr = new JLabel(s);
		add(lblPizzaNom);
		add(lblPizzaIngr);
		setBorder(BorderFactory.createMatteBorder(1, 1, 1, 1, Color.BLACK));
		
	}
	
	public void pizzaFinie() {
		setBorder(BorderFactory.createMatteBorder(1, 1, 1, 1, Color.RED));

		modele.setPrete(true); // SQL
	}
	
}
