public class Abonnement {
    private String type;
    private int duree; // Durée de l'abonnement en mois
    private double cout; // Coût de l'abonnement
    // Autres attributs pertinents

    public Abonnement() {
        // Constructeur par défaut
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public int getDuree() {
        return duree;
    }

    public void setDuree(int duree) {
        this.duree = duree;
    }

    public double getCout() {
        return cout;
    }

    public void setCout(double cout) {
        this.cout = cout;
    }

    // Autres méthodes getters et setters pour les attributs pertinents
}
