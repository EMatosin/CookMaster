import java.util.List;

public class Evenement {
    private String type;
    private String nom;
    private String contenu;
    private List<Reservation> reservations;
    private List<Planification> planifications;
    private int demande;



    public int getDemande() {
        return demande;
    }
    public void setDemande(int demande) {
        this.demande = demande;
    }

    public String getNom() { return nom; }
    public void setNom(String nom) {
        this.nom = nom;
    }

    public void setType(String s) {
    }
    public void setFrequence(int i) {
    }


    // Autres attributs pertinents

    // Constructeur, getters et setters
}
