package vue;

import java.awt.*;
import java.sql.*;
import java.util.ArrayList;

import javax.swing.*;

import modele.*;
import controlleur.ControlleurPizza;

public class Fenetre extends JFrame {

    private JPanel panelCentral;
    private ListePizzas liste;
    private ThreadUpdate threadUpdate;

    public Fenetre(ListePizzas liste) {
        panelCentral = new JPanel();
        redessiner(liste);
        
        threadUpdate = new ThreadUpdate(liste, this);
        threadUpdate.start();
    }

    public void redessiner(ListePizzas liste) {
        SwingUtilities.invokeLater(() -> {
            panelCentral.removeAll();
            panelCentral.revalidate();
            panelCentral.repaint();
            this.liste = liste;
            VueListePizzas vueListe = new VueListePizzas(liste);
            panelCentral.add(vueListe);
            this.add(panelCentral);
        });
    }

    public ListePizzas getListe() {
        return liste;
    }

    public void setListe(ListePizzas liste) {
        this.liste = liste;
    }

    public static void main(String[] args) {
        // Create some ingredients
        Ingredient cheese = new Ingredient(1, "Cheese");
        Ingredient tomato = new Ingredient(2, "Tomato");
        Ingredient pepperoni = new Ingredient(3, "Pepperoni");

        // Create some pizzas
        ArrayList<Ingredient> ingredients1 = new ArrayList<>(Arrays.asList(cheese, tomato));
        ArrayList<Double> quantities1 = new ArrayList<>(Arrays.asList(0.2, 0.3));
        Pizza pizza1 = new Pizza(1, 1, "Margherita", ingredients1, quantities1, new Time(System.currentTimeMillis()), false);

        ArrayList<Ingredient> ingredients2 = new ArrayList<>(Arrays.asList(cheese, pepperoni));
        ArrayList<Double> quantities2 = new ArrayList<>(Arrays.asList(0.2, 0.4));
        Pizza pizza2 = new Pizza(2, 2, "Pepperoni", ingredients2, quantities2, new Time(System.currentTimeMillis()), false);

        // Add pizzas to the list
        ArrayList<Pizza> al = new ArrayList<>(Arrays.asList(pizza1, pizza2));
        ListePizzas l = new ListePizzas(al);

        // Create and display the window
        Fenetre fn = new Fenetre(l);
        fn.setPreferredSize(new Dimension(1000, 900));
        fn.pack();
        fn.setTitle("Interface Pizzaiolo");
        fn.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        fn.setVisible(true);
    }
}

