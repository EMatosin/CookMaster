import java.util.List;

public class Evenement {
    private String type;
    private String nom;
    private String contenu;
    private List<Reservation> reservations;
    private int demande;

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

    public String getContenu() {
        return contenu;
    }

    public void setContenu(String contenu) {
        this.contenu = contenu;
    }

    public List<Reservation> getReservations() {
        return reservations;
    }

    public void setReservations(List<Reservation> reservations) {
        this.reservations = reservations;
    }

}