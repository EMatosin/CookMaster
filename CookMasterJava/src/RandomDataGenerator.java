//
// Source code recreated from a .class file by IntelliJ IDEA
// (powered by FernFlower decompiler)
//

import com.github.javafaker.Faker;
import java.time.LocalDate;
import java.time.ZoneId;
import java.util.*;
import java.util.concurrent.TimeUnit;

public class RandomDataGenerator {
    private static final Faker faker = new Faker();
    private static final Random random = new Random();

    public RandomDataGenerator() {
    }

    public static List<Client> generateRandomClients(int count) {
        List<Client> clients = new ArrayList<>();
        List<String> randomNames = generateRandomNames(count);
        List<String> randomAddresses = generateRandomAddresses(count);

        for(int i = 0; i < count; ++i) {
            Client client = new Client();
            client.setNom(randomNames.get(i));
            client.setAdresse(randomAddresses.get(i));
            client.setAbonnements(generateRandomAbonnements());
            client.setEvenements(generateRandomEvenement()); // Ajout de la génération d'événements aléatoires
            client.setPrestations(generateRandomPrestations()); // Ajout de la génération de prestations aléatoires
            client.setFactures(generateRandomFactures(client.getAbonnements(), client.getEvenements(), client.getPrestations()));
            clients.add(client);
        }

        return clients;
    }

    public static List<String> generateRandomNames(int count) {
        List<String> names = new ArrayList<>();

        for(int i = 0; i < count; ++i) {
            String firstName = faker.name().firstName();
            String lastName = faker.name().lastName();
            String fullName = firstName + " " + lastName;
            names.add(fullName);
        }

        return names;
    }

    public static List<String> generateRandomAddresses(int count) {
        List<String> addresses = new ArrayList<>();

        for(int i = 0; i < count; ++i) {
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
        String[] types = new String[]{"Basic", "Premium", "Pro"};
        int index = random.nextInt(types.length);
        return types[index];
    }

    static int generateRandomAbonnementDuree() {
        int minDuree = 1;
        int maxDuree = 48;
        return random.nextInt(maxDuree - minDuree + 1) + minDuree;
    }

    static LocalDate generateRandomAbonnementDate() {
        Date date = faker.date().past(365, TimeUnit.DAYS);
        return date.toInstant().atZone(ZoneId.systemDefault()).toLocalDate();
    }

    private static double calculateTotalMontant(List<Abonnement> abonnements, List<Evenement> evenements, List<Prestation> prestations) {
        double totalMontant = 0.0;

        // Somme des montants des abonnements
        for (Abonnement abonnement : abonnements) {
            totalMontant += abonnement.calculerCoutAbonnement();
        }

        // Somme des montants des événements
        for (Evenement evenement : evenements) {
            double eventTypeCost = getEventTypeCost(evenement.getType());
            int numReservations = evenement.getReservations().size();
            totalMontant += eventTypeCost * numReservations;
        }

        // Somme des montants des prestations
        for (Prestation prestation : prestations) {
            double prestationTypeCost = getPrestationTypeCost(prestation.getType());
            int numPrestations = prestation.getNombreReservations();
            totalMontant += prestationTypeCost * numPrestations;
        }

        return totalMontant;
    }


    static List<Facture> generateRandomFactures(List<Abonnement> abonnements, List<Evenement> evenements, List<Prestation> prestations) {
        List<Facture> factures = new ArrayList<>();
        Facture facture = new Facture();

        double totalMontant = calculateTotalMontant(abonnements, evenements, prestations);
        facture.setMontant(totalMontant);

        factures.add(facture);
        return factures;
    }

    public static List<Evenement> generateRandomEvenement() {
        List<Evenement> evenements = new ArrayList<>();
        int numEventTypes = random.nextInt(3);

        for (int i = 0; i < numEventTypes; ++i) {
            Evenement evenement = new Evenement();
            evenement.setType(generateRandomEventType());

            switch (evenement.getType()) {
                case "Entretien VIP" -> evenement.setNom(generateRandomVIP());
                case "Cours à domicile", "Cours/Stream collectif" -> evenement.setNom(generateRandomEventContent());
                case "Dégustation/Activité en plein air" -> evenement.setNom(generateRandomEventLocalContent());
            }

            evenement.setReservations(generateRandomReservationsForEventType(evenement.getType()));
            evenement.setDemande(evenement.getReservations().size());
            evenements.add(evenement);
        }
        return evenements;
    }

    private static final Map<String, Double> eventTypesAndCosts = new HashMap<>();

    static {
        eventTypesAndCosts.put("Cours à domicile", 100.0);
        eventTypesAndCosts.put("Dégustation/Activité en plein air", 150.0);
        eventTypesAndCosts.put("Cours/Stream collectif", 50.0);
        eventTypesAndCosts.put("Entretien(s) VIP", 200.0);
    }

    private static String generateRandomEventType() {
        String[] types = eventTypesAndCosts.keySet().toArray(new String[0]);
        int index = random.nextInt(types.length);
        return types[index];
    }

    static double getEventTypeCost(String eventType) {
        return eventTypesAndCosts.getOrDefault(eventType, 0.0);
    }

    private static String generateRandomVIP() {
        String[] vip = new String[]{"Philippe Etchebest", "Cyril Lignac", "Alain Ducasse", "Gordon Ramsay", "Stephanie Le Quellec", "Guy Savoy", "Anne-Sophie Pic", "Eric Frechon", "Hélène Darroze", "Ghislaine Arabian", "Pierre Gagnaire", "Thierry Marx", "Olivier Roellinger"};
        int index = random.nextInt(vip.length);
        return vip[index];
    }

    private static String generateRandomEventContent() {
        String[] culinaryActivities = new String[]{"Cours de cuisine italienne", "Atelier de pâtisserie française", "Initiation à la cuisine japonaise", "Cours de mixologie", "Cuisine moléculaire", "Atelier de chocolaterie", "Démonstration de cuisine fusion", "Atelier de fabrication de sushi", "Cours de cuisine végétarienne", "Atelier de cuisine méditerranéenne", "Cuisine asiatique : wok et sautés", "Atelier de décoration de gâteaux"};
        int index = random.nextInt(culinaryActivities.length);
        return culinaryActivities[index];
    }

    private static String generateRandomEventLocalContent() {
        String[] culinaryLocalActivities = new String[]{"Visite d'une cave à vin locale avec dégustation", "Excursion à la ferme pour cueillir des fruits et légumes", "Dîner gastronomique mettant en valeur les produits régionaux", "Cours de cuisine traditionnelle de la région", "Marché des producteurs locaux avec dégustation", "Atelier de préparation de plats régionaux", "Balade gastronomique dans les rues de la ville", "Dégustation de spécialités culinaires locales", "Rencontre avec un chef renommé pour une démonstration culinaire", "Exploration des traditions culinaires ancestrales de la région"};
        int index = random.nextInt(culinaryLocalActivities.length);
        return culinaryLocalActivities[index];
    }

    private static List<Reservation> generateRandomReservationsForEventType(String eventType) {
        List<Reservation> reservations = new ArrayList<>();
        int numReservations = random.nextInt(3) + 1;

        for(int i = 0; i < numReservations; ++i) {
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

    public static List<Prestation> generateRandomPrestations() {
        List<Prestation> prestations = new ArrayList<>();
        int numPrestations = random.nextInt(3);

        for (int i = 0; i < numPrestations; ++i) {
            Prestation prestation = new Prestation();
            prestation.setType(generateRandomPrestationType());
            prestation.setDetails(generateRandomDetailsForPrestationType(prestation.getType()));
            prestation.setCost(getPrestationTypeCost(prestation.getType()));
            prestation.setNombreReservations(random.nextInt(5) + 1); // Génère un nombre aléatoire de réservations entre 1 et 5
            prestations.add(prestation);
        }

        return prestations;
    }


    private static final Map<String, Double> prestationTypesAndCosts = new HashMap<>();

    static {
        prestationTypesAndCosts.put("Salles", 50.0);
        prestationTypesAndCosts.put("Nourriture", 25.0);
        prestationTypesAndCosts.put("Traiteur", 20.0);
        prestationTypesAndCosts.put("Animation", 45.0);
    }

    private static String generateRandomPrestationType() {
        String[] types = prestationTypesAndCosts.keySet().toArray(new String[0]);
        int index = random.nextInt(types.length);
        return types[index];
    }

    static double getPrestationTypeCost(String prestationType) {
        return prestationTypesAndCosts.getOrDefault(prestationType, 0.0);
    }

    private static String generateRandomSalleDetails() {
        String[] salleTypes = new String[]{"Cuisine de restaurant", "Plein air", "Salle de réception", "Salle de formation", "Cuisine d'hôtel", "Cave à vin", "Salle de dégustation", "Salle de banquet", "Salle de démonstration culinaire", "Terrasse avec vue panoramique"};
        int index = random.nextInt(salleTypes.length);
        String salleType = salleTypes[index];
        int capacity = random.nextInt(20) + 10;
        String[] equipment = new String[]{"Four à pierre", "Robot cuisinier", "Marmite en or", "Moule gigantesque", "Machine barbe à papa", "Plancha", "Friteuse industrielle", "Machine à glace", "Mixeur professionnel", "Presse-agrumes"};
        Set<String> availableEquipment = new HashSet<>();
        int numEquipment = random.nextInt(equipment.length) + 1;

        while(availableEquipment.size() < numEquipment) {
            int equipmentIndex = random.nextInt(equipment.length);
            availableEquipment.add(equipment[equipmentIndex]);
        }

        String[] services = new String[]{"Service de restauration", "Service de café", "Service de pâtisserie", "Service de sommellerie", "Service de décoration de table", "Service de gestion des stocks", "Service de nettoyage de cuisine", "Service de conseil en menu"};
        Set<String> additionalServices = new HashSet<>();
        int numServices = random.nextInt(services.length) + 1;

        while(additionalServices.size() < numServices) {
            int serviceIndex = random.nextInt(services.length);
            additionalServices.add(services[serviceIndex]);
        }

        StringBuilder details = new StringBuilder();
        details.append("Type de salle : ").append(salleType).append("\n");
        details.append("Capacité : ").append(capacity).append(" personnes").append("\n");
        details.append("Équipements disponibles : ");
        int i = 0;

        Iterator var12;
        String serviceItem;
        for(var12 = availableEquipment.iterator(); var12.hasNext(); ++i) {
            serviceItem = (String)var12.next();
            details.append(serviceItem);
            if (i < availableEquipment.size() - 1) {
                details.append(", ");
            }
        }

        details.append("\n");
        details.append("Services supplémentaires : ");
        i = 0;

        for(var12 = additionalServices.iterator(); var12.hasNext(); ++i) {
            serviceItem = (String)var12.next();
            details.append(serviceItem);
            if (i < additionalServices.size() - 1) {
                details.append(", ");
            }
        }

        details.append("\n");
        return details.toString();
    }

    private static String generateRandomFoodDetails() {
        String[] foodTypes = new String[]{"Fruits exotiques", "Viandes de choix", "Poisson frais", "Légumes confits", "Fromages raffinés", "Desserts gourmands", "Plats végétariens", "Spécialités régionales", "Plats épicés", "Produits biologiques"};
        int index = random.nextInt(foodTypes.length);
        String foodType = foodTypes[index];
        return "Type de nourriture : " + foodType + "\n";
    }

    private static String generateRandomTraiteurDetails() {
        String[] serviceTypes = new String[]{"Cocktail", "Buffet", "Menu à la carte", "Table d'hôte", "Service à l'assiette", "Food truck", "Service traiteur", "Brunch", "Bar à cocktails", "Service de dégustation"};
        int index = random.nextInt(serviceTypes.length);
        String serviceType = serviceTypes[index];
        return "Type de service : " + serviceType + "\n";
    }

    private static String generateRandomAnimationDetails() {
        String[] animationTypes = new String[]{"Challenges en duo!", "Thème spécial!", "Duel entre novices!", "Ingrédients surprises!", "Atelier de dégustation", "Démonstration culinaire", "Concours de cuisine", "Animation musicale", "Soirée à thème", "Spectacle de chefs cuisiniers"};
        int index = random.nextInt(animationTypes.length);
        String animationType = animationTypes[index];
        return "Type d'animation : " + animationType + "\n";
    }

    private static String generateRandomDetailsForPrestationType(String prestationType) {
        return switch (prestationType) {
            case "Salles" -> generateRandomSalleDetails();
            case "Nourriture" -> generateRandomFoodDetails();
            case "Traiteur" -> generateRandomTraiteurDetails();
            case "Animation" -> generateRandomAnimationDetails();
            default -> "";
        };
    }
}
