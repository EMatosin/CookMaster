import java.util.ArrayList;
import java.util.List;

public class Evenement {
    private String type;
    private String nom;

    private List<Reservation> reservations;
    private int demande;


    public Evenement() {
    }

    public int getDemande() {
        return demande;
    }

    public void setDemande(int demande) {
        this.demande = demande;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }


    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }



    public List<Reservation> getReservations() {
        return reservations;
    }
    public void setReservations(List<Reservation> reservations) {
        this.reservations = reservations;
    }


    public int getEvenementDetails() {
        double evenementTypeCost = RandomDataGenerator.getEventTypeCost(getType());
        int numDemande = getDemande();
        return (int) (evenementTypeCost * numDemande);
    }

    public String toString() {
        return "Nom: " + nom + ", Demande: " + demande + ", Type: " + type;
    }
}