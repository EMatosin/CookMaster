import java.util.List;

public class Client {
    private String nom;
    private String adresse;
    private List<Abonnement> abonnements;
    private List<Facture> factures;
    private int fidelite;
    private List<Evenement> evenements;
    private List<Prestation> prestations;



    public String getNom() { return nom; }

    public void setNom(String nom) { this.nom = nom; }

    public String getAdresse() {
        return adresse;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public List<Abonnement> getAbonnements() {
        return abonnements;
    }

    public void setAbonnements(List<Abonnement> abonnements) {
        this.abonnements = abonnements;
    }

    public List<Facture> getFactures() {
        return factures;
    }

    public void setFactures(List<Facture> factures) {
        this.factures = factures;
    }

    public int getFidelite() { return fidelite; }

    public void setFidelite(int fidelite) { this.fidelite = fidelite; }

    public List<Evenement> getEvenements() {
        return evenements;
    }

    public void setEvenements(List<Evenement> evenements) {
        this.evenements = evenements;
    }

    public List<Prestation> getPrestations() {
        return prestations;
    }

    public void setPrestations(List<Prestation> prestations) {
        this.prestations = prestations;
    }

}