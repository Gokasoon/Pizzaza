package modele;

import java.util.ArrayList;

public class ListePizzas {
	private ArrayList<Pizza> liste;

	
	public ArrayList<Pizza> getListe() {
		return liste;
	}

	public void setListe(ArrayList<Pizza> listes) {
		this.liste = listes;
	}
	
	public ListePizzas(ArrayList<Pizza> listes) {
		this.liste = listes;
	}
	
	
	

}
