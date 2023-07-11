import java.time.LocalDate;

public class Abonnement {
    private String type;
    private int duree;
    private int cout;
    private LocalDate dateDebut;
    private static final double DEFAULT_PREMIUM_PRICE = 20.0;
    private static final double DEFAULT_PRO_PRICE = 10.0;
    private static final double DEFAULT_STANDARD_PRICE = 3.0;

    private static double premiumPrice = DEFAULT_PREMIUM_PRICE;
    private static double proPrice = DEFAULT_PRO_PRICE;
    private static double standardPrice = DEFAULT_STANDARD_PRICE;

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

        double prixUnitaire;

        if (typeAbonnement.equals("Premium")) {
            prixUnitaire = premiumPrice;
        } else if (typeAbonnement.equals("Pro")) {
            prixUnitaire = proPrice;
        } else {
            prixUnitaire = standardPrice;
        }

        setCout((int) (prixUnitaire * dureeAbonnement));
        return getCout();
    }

    public LocalDate getDateDebut() {
        return dateDebut;
    }

    public void setDateDebut(LocalDate dateDebut) {
        this.dateDebut = dateDebut;
    }

    public static void setPrixAbonnement(String type, double prix) {
        if (type.equals("Premium")) {
            premiumPrice = prix;
        } else if (type.equals("Pro")) {
            proPrice = prix;
        } else if (type.equals("Standard")) {
            standardPrice = prix;
        }
    }

    public static void resetPrixAbonnements() {
        premiumPrice = DEFAULT_PREMIUM_PRICE;
        proPrice = DEFAULT_PRO_PRICE;
        standardPrice = DEFAULT_STANDARD_PRICE;
    }
}
