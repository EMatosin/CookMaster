import com.github.javafaker.Faker;

import java.time.ZoneId;
import java.util.*;
import java.util.concurrent.TimeUnit;
import java.time.LocalDate;


public class RandomDataGenerator {

    private static final Faker faker = new Faker();
    private static final Random random = new Random();




    // Génération des données aléatoires pour les informations des clients



    public static List<Client> generateRandomClients(int count) {
        List<Client> clients = new ArrayList<>();
        List<String> randomNames = generateRandomNames(count);
        List<String> randomAddresses = generateRandomAddresses(count);


        for (int i = 0; i < count; i++) {
            Client client = new Client();
            client.setNom(randomNames.get(i));
            client.setAdresse(randomAddresses.get(i));
            client.setAbonnements(generateRandomAbonnements());
            client.setFactures(generateRandomFactures());
            //client.setPrestations(RandomDataGenerator.generateRandomPrestations());

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




    // Génération des données aléatoires pour les différents abonnements



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




    // Génération des données aléatoires pour les factures



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




    // Génération des données aléatoires pour les différents évènements



    public static List<Evenement> generateRandomEvenement() {
        List<Evenement> events = new ArrayList<>();
        int numEventTypes = random.nextInt(3) + 1;

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
            String content = switch (eventType) {
                case "Entretien VIP" -> generateRandomVIP();
                case "Cours à domicile", "Cours/Stream collectif" -> generateRandomEventContent();
                case "Dégustation/Activité en plein air" -> generateRandomEventLocalContent();
                default -> "";
            };

            reservation.setContenu(content);
            reservations.add(reservation);
        }

        return reservations;
    }




    // Génération des données aléatoires pour les prestations



    public static List<Prestation> generateRandomPrestations() {
        List<Prestation> prestations = new ArrayList<>();
        int numPrestations = random.nextInt(3) + 1; // Génère un nombre aléatoire entre 1 et 3

        for (int i = 0; i < numPrestations; i++) {
            Prestation prestation = new Prestation();
            prestation.setType(generateRandomPrestationType());

            switch (prestation.getType()) {
                case "Salles" -> prestation.setDetails(generateRandomSalleDetails());
                case "Nourriture" -> prestation.setDetails(generateRandomFoodDetails());
                case "Traiteur" -> prestation.setDetails(generateRandomTraiteurDetails());
                case "Animation" -> prestation.setDetails(generateRandomAnimationDetails());
            }

            prestations.add(prestation);
        }

        return prestations;
    }

    private static String generateRandomPrestationType() {
        String[] types = {"Salles", "Nourriture", "Traiteur", "Animation"};
        int index = random.nextInt(types.length);
        return types[index];
    }

    private static String generateRandomSalleDetails() {
        String[] salleTypes = {"Cuisine de restaurant", "Plein air", "Salle de réception", "Salle de formation",
                "Cuisine d'hôtel", "Cave à vin", "Salle de dégustation", "Salle de banquet",
                "Salle de démonstration culinaire", "Terrasse avec vue panoramique"};
        int index = random.nextInt(salleTypes.length);
        String salleType = salleTypes[index];

        int capacity = random.nextInt(20) + 1;

        String[] equipment = {"Four à pierre", "Robot cuisinier", "Marmite en or", "Moule gigantesque",
                "Machine barbe à papa", "Plancha", "Friteuse industrielle", "Machine à glace", "Mixeur professionnel",
                "Presse-agrumes"};
        Set<String> availableEquipment = new HashSet<>();
        int numEquipment = random.nextInt(equipment.length) + 1;
        while (availableEquipment.size() < numEquipment) {
            int equipmentIndex = random.nextInt(equipment.length);
            availableEquipment.add(equipment[equipmentIndex]);
        }

        String[] services = {"Service de restauration", "Service de café", "Service de pâtisserie",
                "Service de sommellerie", "Service de décoration de table", "Service de gestion des stocks",
                "Service de nettoyage de cuisine", "Service de conseil en menu"};
        Set<String> additionalServices = new HashSet<>();
        int numServices = random.nextInt(services.length) + 1;
        while (additionalServices.size() < numServices) {
            int serviceIndex = random.nextInt(services.length);
            additionalServices.add(services[serviceIndex]);
        }

        StringBuilder details = new StringBuilder();
        details.append("Type de salle : ").append(salleType).append("\n");
        details.append("Capacité : ").append(capacity).append(" personnes").append("\n");

        details.append("Équipements disponibles : ");
        int i = 0;
        for (String equipmentItem : availableEquipment) {
            details.append(equipmentItem);
            if (i < availableEquipment.size() - 1) {
                details.append(", ");
            }
            i++;
        }
        details.append("\n");


        details.append("Services supplémentaires : ");
        i = 0;
        for (String serviceItem : additionalServices) {
            details.append(serviceItem);
            if (i < additionalServices.size() - 1) {
                details.append(", ");
            }
            i++;
        }
        details.append("\n");

        return details.toString();
    }

    private static String generateRandomFoodDetails() {
        String[] foodTypes = {"Fruits exotiques", "Viandes de choix", "Poisson frais", "Légumes confits",
                "Fromages raffinés", "Desserts gourmands", "Plats végétariens", "Spécialités régionales",
                "Plats épicés", "Produits biologiques"};
        int index = random.nextInt(foodTypes.length);
        String foodType = foodTypes[index];
        return "Type de nourriture : " + foodType + "\n";
    }

    private static String generateRandomTraiteurDetails() {
        String[] serviceTypes = {"Cocktail", "Buffet", "Menu à la carte", "Table d'hôte", "Service à l'assiette",
                "Food truck", "Service traiteur", "Brunch", "Bar à cocktails", "Service de dégustation"};
        int index = random.nextInt(serviceTypes.length);
        String serviceType = serviceTypes[index];
        return "Type de service : " + serviceType + "\n";
    }

    private static String generateRandomAnimationDetails() {
        String[] animationTypes = {"Challenges en duo!", "Thème spécial!", "Duel entre novices!",
                "Ingrédients surprises!", "Atelier de dégustation", "Démonstration culinaire",
                "Concours de cuisine", "Animation musicale", "Soirée à thème", "Spectacle de chefs cuisiniers"};
        int index = random.nextInt(animationTypes.length);
        String animationType = animationTypes[index];
        return "Type d'animation : " + animationType + "\n";
    }
}
