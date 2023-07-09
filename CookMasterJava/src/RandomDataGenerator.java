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
            String firstName = faker.name().firstName();
            String lastName = faker.name().lastName();
            String fullName = firstName + " " + lastName;
            names.add(fullName);
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
        abonnement.calculerCoutAbonnement();

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

    public static List<Evenement> generateRandomEvenement() {
        List<Evenement> events = new ArrayList<>();
        int numEventTypes = random.nextInt(3) + 1; // Génère un nombre aléatoire entre 1 et 3

        for (int i = 0; i < numEventTypes; i++) {
            Evenement evenement = new Evenement();
            evenement.setNom(generateRandomVIP());
            evenement.setType(generateRandomEventType());
            evenement.setReservations(generateRandomReservationsForEventType(evenement.getType()));
            evenement.setDemande(evenement.getReservations().size());
            events.add(evenement);
        }

        return events;
    }

    private static String generateRandomEventType() {
        String[] types = {"Cours à domicile", "Dégustation/Activité en plein air", "Cours/Stream collectif", "Entretien(s) VIP"};
        int index = random.nextInt(types.length);
        return types[index];
    }

    private static String generateRandomVIP() {
        String[] vip = {"Philippe Etchebest", "Cyril Lignac", "Alain Ducasse", "Gordon Ramsay", "Stephanie Le Quellec", "Guy Savoy", "Anne-Sophie Pic", "Eric Frechon"
                , "Hélène Darroze","Ghislaine Arabian", "Pierre Gagnaire", "Thierry Marx", "Olivier Roellinger" };
        int index = random.nextInt(vip.length);
        return vip[index];
    }

    private static String generateRandomEventContent() {
        String[] culinaryActivities = {
                "Cours de cuisine italienne",
                "Atelier de pâtisserie française",
                "Initiation à la cuisine japonaise",
                "Cours de mixologie",
                "Cuisine moléculaire",
                "Atelier de chocolaterie",
                "Démonstration de cuisine fusion",
                "Atelier de fabrication de sushi",
                "Cours de cuisine végétarienne",
                "Atelier de cuisine méditerranéenne",
                "Cuisine asiatique : wok et sautés",
                "Atelier de décoration de gâteaux"
        };

        int index = random.nextInt(culinaryActivities.length);
        return culinaryActivities[index];
    }

    private static String generateRandomEventLocalContent() {
        String[] culinaryLocalActivities = {
                "Visite d'une cave à vin locale avec dégustation",
                "Excursion à la ferme pour cueillir des fruits et légumes",
                "Dîner gastronomique mettant en valeur les produits régionaux",
                "Cours de cuisine traditionnelle de la région",
                "Marché des producteurs locaux avec dégustation",
                "Atelier de préparation de plats régionaux",
                "Balade gastronomique dans les rues de la ville",
                "Dégustation de spécialités culinaires locales",
                "Rencontre avec un chef renommé pour une démonstration culinaire",
                "Exploration des traditions culinaires ancestrales de la région"
        };

        int index = random.nextInt(culinaryLocalActivities.length);
        return culinaryLocalActivities[index];
    }

    private static List<Reservation> generateRandomReservationsForEventType(String eventType) {
        List<Reservation> reservations = new ArrayList<>();
        int numReservations = random.nextInt(3) + 1; // Génère un nombre aléatoire entre 1 et 3

        for (int i = 0; i < numReservations; i++) {
            Reservation reservation = new Reservation();
            String content = "";

            if (eventType.equals("Entretien VIP")) {
                content = generateRandomVIP();
            } else if (eventType.equals("Cours à domicile") || eventType.equals("Cours/Stream collectif")) {
                content = generateRandomEventContent();
            } else if (eventType.equals("Dégustation/Activité en plein air")) {
                content = generateRandomEventLocalContent();
            }

            reservation.setContenu(content);
            reservations.add(reservation);
        }

        return reservations;
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
