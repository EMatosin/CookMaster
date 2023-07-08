import java.util.List;

public class Main {
    public static void main(String[] args) {
        // Génération de clients aléatoires
        List<Client> clients = RandomDataGenerator.generateRandomClients(30);
        // Génération d'événements aléatoires
        List<Evenement> evenements = RandomDataGenerator.generateRandomEvenements(20);

        // Génération de prestations aléatoires
        List<Prestation> prestations = RandomDataGenerator.generateRandomPrestations(10);


        // Génération des abonnements, des devis et des factures pour chaque client
        for (Client client : clients) {
            client.setAbonnements(RandomDataGenerator.generateRandomAbonnements());
            client.setDevis(RandomDataGenerator.generateRandomDevis());
            client.setFactures(RandomDataGenerator.generateRandomFactures());
        }

        // Génération du rapport PDF pour l'ensemble des clients
        PDFGenerator.generateReport(clients, evenements, prestations);
    }
}
