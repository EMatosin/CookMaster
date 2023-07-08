import java.util.List;

public class Main {
    public static void main(String[] args) {
        // Génération de clients aléatoires
        List<Client> clients = RandomDataGenerator.generateRandomClients(5);

        // Génération des abonnements, des devis et des factures pour chaque client
        for (Client client : clients) {
            client.setAbonnements(RandomDataGenerator.generateRandomAbonnements());
            client.setDevis(RandomDataGenerator.generateRandomDevis());
            client.setFactures(RandomDataGenerator.generateRandomFactures());
        }

        // Affichage des clients et de leurs informations
        for (Client client : clients) {
            System.out.println("Nom du client : " + client.getNom());
            System.out.println("Adresse du client : " + client.getAdresse());

            // Affichage des abonnements du client
            List<Abonnement> abonnements = client.getAbonnements();
            System.out.println("Abonnements du client :");
            for (Abonnement abonnement : abonnements) {
                System.out.println("Type d'abonnement : " + abonnement.getType());
                System.out.println("Durée de l'abonnement : " + abonnement.getDuree() + " mois");
                System.out.println("Coût de l'abonnement : " + abonnement.getCout());
                System.out.println("------------------------------------");
            }

            // Affichage des devis du client
            List<Devis> devis = client.getDevis();
            System.out.println("Devis du client :");
            if (devis.isEmpty()) {
                System.out.println("Aucun devis disponible");
            } else {
                for (Devis devisClient : devis) {
                    System.out.println("Montant du devis : " + devisClient.getMontant());
                    System.out.println("------------------------------------");
                }
            }

            // Affichage des factures du client
            List<Facture> factures = client.getFactures();
            System.out.println("Factures du client :");
            if (factures.isEmpty()) {
                System.out.println("Aucune facture disponible");
            } else {
                for (Facture facture : factures) {
                    System.out.println("Montant de la facture : " + facture.getMontant());
                    System.out.println("------------------------------------");
                }
            }

            System.out.println("------------------------------------");
        }

        for (Client client : clients) {
            client.setAbonnements(RandomDataGenerator.generateRandomAbonnements());
            client.setDevis(RandomDataGenerator.generateRandomDevis());
            client.setFactures(RandomDataGenerator.generateRandomFactures());

            // Génération du rapport PDF pour chaque client
            PDFGenerator.generateReport(client, clients);
        }
    }
}
