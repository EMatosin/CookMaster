import java.util.ArrayList;
import java.util.List;
import java.util.Random;

public class RandomDataGenerator {
    private static final Random random = new Random();

    public static List<Client> generateRandomClients(int count) {
        List<Client> clients = new ArrayList<>();
        for (int i = 0; i < count; i++) {
            Client client = new Client();
            client.setNom(generateRandomName());
            client.setAdresse(generateRandomAddress());
            client.setAbonnements(generateRandomAbonnements());
            client.setDevis(generateRandomDevis());
            client.setFactures(generateRandomFactures());
            // Autres attributs pertinents

            clients.add(client);
        }
        return clients;
    }

    private static String generateRandomName() {
        String[] names = {"John", "Emma", "Michael", "Sophia", "Daniel"};
        int index = random.nextInt(names.length);
        return names[index];
    }

    private static String generateRandomAddress() {
        String[] addresses = {"123 Street", "456 Avenue", "789 Road"};
        int index = random.nextInt(addresses.length);
        return addresses[index];
    }

    static List<Abonnement> generateRandomAbonnements() {
        List<Abonnement> abonnements = new ArrayList<>();

        Abonnement abonnement = new Abonnement();
        abonnement.setType(generateRandomAbonnementType());
        // Autres attributs pertinents

        abonnements.add(abonnement);

        return abonnements;
    }

    private static String generateRandomAbonnementType() {
        String[] types = {"Premium", "Standard", "Basic"};
        int index = random.nextInt(types.length);
        return types[index];
    }

    static List<Devis> generateRandomDevis() {
        List<Devis> devis = new ArrayList<>();

        Devis devisItem = new Devis();
        devisItem.setMontant(generateRandomMontant());
        // Autres attributs pertinents

        devis.add(devisItem);

        return devis;
    }

    private static double generateRandomMontant() {
        double minMontant = 100.0;
        double maxMontant = 1000.0;
        return minMontant + (maxMontant - minMontant) * random.nextDouble();
    }

    static List<Facture> generateRandomFactures() {
        List<Facture> factures = new ArrayList<>();

        Facture facture = new Facture();
        facture.setMontant(generateRandomMontant());
        // Autres attributs pertinents

        factures.add(facture);

        return factures;
    }
}
