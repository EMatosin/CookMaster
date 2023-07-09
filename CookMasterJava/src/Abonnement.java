import java.time.LocalDate;

public class Abonnement {
    private String type;
    private int duree;
    private int cout;
    private LocalDate dateDebut;


    public Abonnement() {}

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

    public int getCout() {
        return cout;
    }

    public void setCout(int cout) {
        this.cout = cout;
    }

    public int calculerCoutAbonnement() {
        String typeAbonnement = getType();
        int dureeAbonnement = getDuree();

        int prixUnitaire;

        if (typeAbonnement.equals("Premium")) {
            prixUnitaire = 20;
        } else if (typeAbonnement.equals("Pro")) {
            prixUnitaire = 10;
        } else {
            prixUnitaire = 3;
        }

        setCout(prixUnitaire * dureeAbonnement);
        return getCout();
    }

    public LocalDate getDateDebut() {
        return dateDebut;
    }

    public void setDateDebut(LocalDate dateDebut) {
        this.dateDebut = dateDebut;
    }


}
