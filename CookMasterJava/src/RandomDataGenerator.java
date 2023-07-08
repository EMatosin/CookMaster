import com.github.javafaker.Faker;

import java.time.ZoneId;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Random;
import java.util.concurrent.TimeUnit;
import java.time.LocalDate;


public class RandomDataGenerator {

    private static Faker faker = new Faker();
    private static final Random random = new Random();

    public static List<Client> generateRandomClients(int count) {
        List<Client> clients = new ArrayList<>();
        List<String> randomNames = generateRandomNames(count);
        List<String> randomAddresses = generateRandomAddresses(count);


        for (int i = 0; i < count; i++) {
            Client client = new Client();
            client.setNom(randomNames.get(i));
            client.setAdresse(randomAddresses.get(i));
            client.setAbonnements(generateRandomAbonnements());
            client.setDevis(generateRandomDevis());
            client.setFactures(generateRandomFactures());
            // Autres attributs pertinents

            clients.add(client);
        }
        return clients;
    }

    public static List<String> generateRandomNames(int count) {
        List<String> names = new ArrayList<>();
        for (int i = 0; i < count; i++) {
            names.add(faker.name().firstName());
        }
        return names;
    }

    public static List<String> generateRandomAddresses(int count) {
        List<String> addresses = new ArrayList<>();
        for (int i = 0; i < count; i++) {
            addresses.add(faker.address().fullAddress());
        }
        return addresses;
    }

    static List<Abonnement> generateRandomAbonnements() {
        List<Abonnement> abonnements = new ArrayList<>();

        Abonnement abonnement = new Abonnement();
        abonnement.setType(generateRandomAbonnementType());
        abonnement.setDuree(generateRandomAbonnementDuree());
        abonnement.setDateDebut(generateRandomAbonnementDate());
        // Other relevant attributes

        abonnements.add(abonnement);

        return abonnements;
    }

    static String generateRandomAbonnementType() {
        // Add logic to generate a random subscription type
        // Example:
        String[] types = {"Basic", "Premium", "Pro"};
        int index = random.nextInt(types.length);
        return types[index];
    }

    static int generateRandomAbonnementDuree() {
        // Add logic to generate a random subscription duration
        // Example:
        int minDuree = 1;
        int maxDuree = 12;
        return random.nextInt(maxDuree - minDuree + 1) + minDuree;
    }

    static LocalDate generateRandomAbonnementDate() {
        // Utilisation de Faker pour générer une date aléatoire
        Date date = faker.date().past(365, TimeUnit.DAYS);
        return date.toInstant().atZone(ZoneId.systemDefault()).toLocalDate();
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

    public static List<Evenement> generateRandomEvenements(int count) {
        List<Evenement> evenements = new ArrayList<>();

        for (int i = 0; i < count; i++) {
            Evenement evenement = new Evenement();
            evenement.setNom(faker.lorem().word());
            evenement.setType(generateRandomEvenementType());
            evenement.setFrequence(generateRandomEvenementFrequence());
            // Autres attributs pertinents

            evenements.add(evenement);
        }

        return evenements;
    }

    public static List<Prestation> generateRandomPrestations(int count) {
        List<Prestation> prestations = new ArrayList<>();

        for (int i = 0; i < count; i++) {
            Prestation prestation = new Prestation();
            prestation.setNom(faker.lorem().word());
            prestation.setType(generateRandomPrestationType());
            prestation.setCout(generateRandomPrestationCout());
            // Autres attributs pertinents

            prestations.add(prestation);
        }

        return prestations;
    }

    private static String generateRandomEvenementType() {
        // Ajouter ici la logique pour générer un type d'événement aléatoire
        // Exemple :
        String[] types = {"Type 1", "Type 2", "Type 3"};
        int index = random.nextInt(types.length);
        return types[index];
    }

    private static int generateRandomEvenementFrequence() {
        // Ajouter ici la logique pour générer une fréquence d'événement aléatoire
        // Exemple :
        int minFrequence = 1;
        int maxFrequence = 10;
        return random.nextInt(maxFrequence - minFrequence + 1) + minFrequence;
    }

    private static String generateRandomPrestationType() {
        // Ajouter ici la logique pour générer un type de prestation aléatoire
        // Exemple :
        String[] types = {"Type 1", "Type 2", "Type 3"};
        int index = random.nextInt(types.length);
        return types[index];
    }

    private static double generateRandomPrestationCout() {
        // Ajouter ici la logique pour générer un coût de prestation aléatoire
        // Exemple :
        double minCout = 100.0;
        double maxCout = 1000.0;
        return minCout + (maxCout - minCout) * random.nextDouble();
    }
}
