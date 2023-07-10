public class Prestation {
    private String type;
    private String details;
    private int nombreReservations;

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public void setCost(double cost) {
    }

    public String getDetails() {
        return details;
    }

    public void setDetails(String details) {
        this.details = details;
    }

    public int getNombreReservations() {
        return nombreReservations;
    }

    public void setNombreReservations(int nombreReservations) {
        this.nombreReservations = nombreReservations;
    }

    public int getPrestationDetails() {
        double prestationTypeCost = RandomDataGenerator.getPrestationTypeCost(getType());
        int numPrestations = getNombreReservations();
        return (int) (prestationTypeCost * numPrestations);
    }
}
