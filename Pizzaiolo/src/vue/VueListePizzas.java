package vue;

import java.awt.*;

import javax.swing.*;

import modele.ListePizzas;
import controlleur.ControlleurPizza;

public class VueListePizzas extends JPanel {
	
	private ListePizzas modele;
	
	public VueListePizzas(ListePizzas pizzas) {
        modele = pizzas;
        VuePizza vue = null;
        ControlleurPizza btn = null;
        setLayout(new GridBagLayout());
        GridBagConstraints gbc = new GridBagConstraints();
        //gbc.gridx = 0;
        gbc.gridy = 0;	
        gbc.insets = new Insets(5, 5, 5, 5);
        gbc.anchor = GridBagConstraints.WEST; 
        gbc.fill = GridBagConstraints.BOTH;

        for (int i = 0; i < pizzas.getListe().size(); i++) {
            vue = new VuePizza(pizzas.getListe().get(i));
            btn = new ControlleurPizza(vue, pizzas.getListe().get(i));
            vue.setAlignmentX(Component.CENTER_ALIGNMENT);
            add(vue, gbc);
            gbc.gridy++;
        }

    }
	
	
}
