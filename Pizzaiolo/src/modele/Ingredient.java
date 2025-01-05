package modele;

public class Ingredient {

	private int id;
	private String nom;

	public int getId() {
		return id;
	}
	
	public String getNom() {
		return nom;
	}

	public void setNom(String nom) {
		this.nom = nom;
	}
	
	
	public Ingredient(int id, String n) {
		this.id = id;
		nom = n;
	}
	
	
	
}
