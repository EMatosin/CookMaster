//
// Source code recreated from a .class file by IntelliJ IDEA
// (powered by FernFlower decompiler)
//

import com.itextpdf.text.Chunk;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.FontFactory;
import com.itextpdf.text.Image;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.ColumnText;
import com.itextpdf.text.pdf.PdfContentByte;
import com.itextpdf.text.pdf.PdfWriter;

import java.awt.*;
import java.io.ByteArrayOutputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.*;
import java.util.List;
import java.util.stream.Collectors;

import org.jfree.chart.ChartFactory;
import org.jfree.chart.ChartFrame;
import org.jfree.chart.ChartUtils;
import org.jfree.chart.JFreeChart;
import org.jfree.chart.labels.StandardPieSectionLabelGenerator;
import org.jfree.chart.plot.PiePlot;
import org.jfree.chart.plot.PlotOrientation;
import org.jfree.data.category.DefaultCategoryDataset;
import org.jfree.data.general.DefaultPieDataset;

public class PDFGenerator {
    public PDFGenerator() {
    }

    public static void generateReport(List<Client> clients, List<Evenement> allevents) {
        Document document = new Document();

        try {
            String fileName = "rapport.pdf";
            PdfWriter writer = PdfWriter.getInstance(document, new FileOutputStream(fileName));
            document.open();
            addTitlePage(document);
            document.add(Chunk.NEWLINE);

            List<Integer> dureesAbonnements = new ArrayList<>(); // Liste des durées des abonnements


            for (Client client : clients) {
                addTitlePageClient(document, client);
                addClientInfoPage(document, client);
                addAbonnementsPage(document, client);
                addClientEvents(document, client);
                addClientPrestations(document, client);
                addFacturesPage(document, client);
                addFooter(writer);
                document.newPage();

                List<Abonnement> abonnements = client.getAbonnements();
                int dureeAbonnementsTotal = 0;

                for (Abonnement abonnement : abonnements) {
                    dureeAbonnementsTotal += abonnement.getDuree();
                }

                dureesAbonnements.add(dureeAbonnementsTotal);
            }

            addClientStatisticsPage(document, clients, dureesAbonnements);
            document.newPage();
            addEventStatisticsPage(document, allevents);
            document.newPage();
            document.close();
            System.out.println("Rapport PDF généré avec succès.");
        } catch (Exception var6) {
            var6.printStackTrace();
        }

    }


    private static void addTitlePage(Document document) throws DocumentException {
        Paragraph title = new Paragraph("Rapport détaillé des activités sur Cook Fusion", FontFactory.getFont("Helvetica-Oblique", 15.0F));
        title.setAlignment(1);
        document.add(title);
        document.add(Chunk.NEWLINE);
    }

    private static void addTitlePageClient(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Détail du compte au nom de : " + client.getNom(), FontFactory.getFont("Helvetica-Bold", 18.0F));
        title.setAlignment(1);
        document.add(title);
        document.add(Chunk.NEWLINE);
    }

    private static void addFooter(PdfWriter writer) throws DocumentException, IOException {
        PdfContentByte cb = writer.getDirectContent();
        Image logo = Image.getInstance("aklogo.png");
        logo.scaleToFit(80.0F, 80.0F);
        logo.setAbsolutePosition((writer.getPageSize().getWidth() - logo.getScaledWidth()) / 2.0F, 40.0F);
        cb.addImage(logo);
        Phrase phrase = new Phrase("Délivré par CookFusion - Votre partenaire culinaire de confiance pour des expériences gastronomiques uniques.", FontFactory.getFont("Helvetica", 10.0F));
        ColumnText.showTextAligned(cb, 1, phrase, writer.getPageSize().getWidth() / 2.0F, 20.0F, 0.0F);
    }

    private static void addClientInfoPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Informations du client", FontFactory.getFont("Helvetica-Bold", 14.0F));
        document.add(title);
        document.add(Chunk.NEWLINE);
        document.add(new Paragraph("Nom du client : " + client.getNom()));
        document.add(new Paragraph("Adresse du client : " + client.getAdresse()));
        document.add(Chunk.NEWLINE);
    }

    private static void addAbonnementsPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Abonnement du client", FontFactory.getFont("Helvetica-Bold", 14.0F));
        document.add(title);
        document.add(Chunk.NEWLINE);
        List<Abonnement> abonnements = client.getAbonnements();

        for (Abonnement abonnement : abonnements) {
            int coutAbonnement = abonnement.calculerCoutAbonnement();
            document.add(new Paragraph("Type d'abonnement : " + abonnement.getType()));
            document.add(new Paragraph("Date de début : " + abonnement.getDateDebut()));
            document.add(new Paragraph("Durée de l'abonnement : " + abonnement.getDuree() + " mois"));
            document.add(new Paragraph("Coût de l'abonnement : " + coutAbonnement + "$"));
            document.add(Chunk.NEWLINE);
        }

    }

    private static void addFacturesPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Factures du client", FontFactory.getFont("Helvetica-Bold", 14.0F));
        document.add(title);
        document.add(Chunk.NEWLINE);
        List<Facture> factures = client.getFactures();

        for (Facture facture : factures) {
            document.add(new Paragraph("Montant de la facture : " + facture.getMontant()));
            document.add(Chunk.NEWLINE);
        }

    }

    private static void addClientEvents(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Événements choisis", FontFactory.getFont("Helvetica-Bold", 14.0F));
        title.setAlignment(0);
        document.add(title);
        document.add(Chunk.NEWLINE);
        List<Evenement> events = client.getEvenements();

        for (Evenement event : events) {
            Paragraph eventDetails = new Paragraph();
            int coutEvenement = event.getEvenementDetails();

            eventDetails.add(new Chunk("Type : ", FontFactory.getFont("Helvetica-Bold")));
            eventDetails.add(new Chunk(event.getType(), FontFactory.getFont("Helvetica")));
            eventDetails.add(Chunk.NEWLINE);
            if (event.getType().equals("Entretien(s) VIP")) {
                eventDetails.add(new Chunk("Nom du VIP choisi: ", FontFactory.getFont("Helvetica-Bold")));
                eventDetails.add(new Chunk(event.getNom(), FontFactory.getFont("Helvetica")));
                eventDetails.add(Chunk.NEWLINE);
            }

            if (!event.getType().equals("Entretien(s) VIP")) {
                List<Reservation> reservations = event.getReservations();
                if (reservations != null && !reservations.isEmpty()) {
                    eventDetails.add(new Chunk("Réservations pour les activités suivantes: ", FontFactory.getFont("Helvetica-Bold")));
                    eventDetails.add(Chunk.NEWLINE);

                    for (Reservation reservation : event.getReservations()) {
                        eventDetails.add(new Chunk(reservation.getContenu(), FontFactory.getFont("Helvetica")));
                        eventDetails.add(Chunk.NEWLINE);
                    }
                }
            }

            eventDetails.add(new Chunk("Nombre total de réservations: ", FontFactory.getFont("Helvetica-Bold")));
            eventDetails.add(new Chunk(String.valueOf(event.getDemande()), FontFactory.getFont("Helvetica")));
            eventDetails.add(Chunk.NEWLINE);
            eventDetails.add(new Chunk("Cout : ", FontFactory.getFont("Helvetica-Bold")));
            eventDetails.add(new Chunk(coutEvenement + "$", FontFactory.getFont("Helvetica")));
            eventDetails.add(Chunk.NEWLINE);
            eventDetails.add(Chunk.NEWLINE);
            document.add(eventDetails);
        }

    }

    private static void addClientPrestations(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Prestations choisis :", FontFactory.getFont("Helvetica-Bold", 14.0F));
        title.setAlignment(0);
        document.add(title);
        document.add(Chunk.NEWLINE);
        List<Prestation> prestations = client.getPrestations();
        if (prestations != null) {

            for (Prestation prestation : prestations) {
                Paragraph prestationDetails = new Paragraph();
                int coutPrestation = prestation.getPrestationDetails();
                prestationDetails.add(new Chunk("Type : ", FontFactory.getFont("Helvetica-Bold")));
                prestationDetails.add(new Chunk(prestation.getType(), FontFactory.getFont("Helvetica")));
                prestationDetails.add(Chunk.NEWLINE);
                prestationDetails.add(new Chunk("Détails : ", FontFactory.getFont("Helvetica-Bold")));
                prestationDetails.add(Chunk.NEWLINE);
                prestationDetails.add(new Chunk(prestation.getDetails(), FontFactory.getFont("Helvetica")));
                prestationDetails.add(new Chunk("Nombre total de prestations: ", FontFactory.getFont("Helvetica-Bold")));
                prestationDetails.add(new Chunk(String.valueOf(prestation.getNombreReservations()), FontFactory.getFont("Helvetica")));
                prestationDetails.add(Chunk.NEWLINE);
                prestationDetails.add(new Chunk("Cout : ", FontFactory.getFont("Helvetica-Bold")));
                prestationDetails.add(new Chunk(coutPrestation + "$", FontFactory.getFont("Helvetica")));
                prestationDetails.add(Chunk.NEWLINE);
                prestationDetails.add(Chunk.NEWLINE);
                document.add(prestationDetails);
            }
        } else {
            document.add(new Paragraph("Aucune prestation choisie."));
        }

    }

    private static void addClientStatisticsPage(Document document, List<Client> clients, List<Integer> dureesAbonnements) throws DocumentException, IOException {
        Paragraph title = new Paragraph("Statistiques des comptes clients", FontFactory.getFont("Helvetica-Bold", 14.0F));
        title.setAlignment(1);
        document.add(title);
        document.add(Chunk.NEWLINE);
        JFreeChart revenueChart = createRevenueChart(clients);
        addChartToDocument(document, revenueChart);
        JFreeChart clientTypeChart = createClientTypeChart(clients);
        addChartToDocument(document, clientTypeChart);
        JFreeChart SubscriptionsChart = createSubscriptionsChart(clients, dureesAbonnements);
        addChartToDocument(document, SubscriptionsChart);
        JFreeChart topCustomersChart = createTopCustomersChart(clients, dureesAbonnements);
        addChartToDocument(document, topCustomersChart);
    }


    private static void addEventStatisticsPage(Document document, List<Evenement> evenements) throws DocumentException, IOException {
        Paragraph title = new Paragraph("Statistiques des événements", FontFactory.getFont("Helvetica-Bold", 14.0F));
        title.setAlignment(1);
        document.add(title);
        document.add(Chunk.NEWLINE);
        JFreeChart eventTypesChart = createEventTypeChart(evenements);
        addChartToDocument(document, eventTypesChart);
        JFreeChart eventFrequencyChart = createEventFrequencyChart(evenements);
        addChartToDocument(document, eventFrequencyChart);
        JFreeChart topRequestedEventsChart = createTopRequestedEventsChart(evenements);
        addChartToDocument(document, topRequestedEventsChart);
    }

    private static void addServiceStatisticsPage(Document document, List<Prestation> prestations) throws DocumentException, IOException {
        Paragraph title = new Paragraph("Statistiques des prestations", FontFactory.getFont("Helvetica-Bold", 14.0F));
        title.setAlignment(1);
        document.add(title);
        document.add(Chunk.NEWLINE);
        JFreeChart serviceTypesChart = createServiceTypeChart(prestations);
        addChartToDocument(document, serviceTypesChart);
        JFreeChart serviceCostChart = createServiceCostChart(prestations);
        addChartToDocument(document, serviceCostChart);
        //JFreeChart serviceEventsCountChart = createTopFrequentServicesChart(prestations);
        //addChartToDocument(document, serviceEventsCountChart);
    }

    private static void addChartToDocument(Document document, JFreeChart chart) throws DocumentException, IOException {
        ByteArrayOutputStream chartImage = new ByteArrayOutputStream();
        ChartUtils.writeChartAsPNG(chartImage, chart, 500, 150);
        Image image = Image.getInstance(chartImage.toByteArray());
        image.setAlignment(1);
        document.add(image);
        document.add(Chunk.NEWLINE);
    }

    private static JFreeChart createRevenueChart(List<Client> clients) {
        DefaultPieDataset dataset = new DefaultPieDataset();

        // Calculer le montant total de facture pour chaque client
        for (Client client : clients) {
            double montantFactureTotal = 0.0;

            for (Facture facture : client.getFactures()) {
                montantFactureTotal += facture.getMontant();
            }

            dataset.setValue(client.getNom(), montantFactureTotal);
        }

        JFreeChart chart = ChartFactory.createPieChart("Répartition par CA", dataset, true, true, false);
        PiePlot plot = (PiePlot) chart.getPlot();
        plot.setLabelFont(new Font("Helvetica", Font.PLAIN, 5));
        plot.setLabelGenerator(null);

        return chart;
    }

    private static JFreeChart createClientTypeChart(List<Client> clients) {
        int countPorteEvenements = 0;
        int countPortePrestations = 0;
        int evenEtPrest = 0;
        int totalCount = clients.size();

        for (Client client : clients) {
            if (client.getPrestations().isEmpty()) {
                countPorteEvenements++;
            } else if (client.getEvenements().isEmpty()) {
                countPortePrestations++;
            } else {
                evenEtPrest++;
            }
        }

        double percentagePorteEvenement = (double) countPorteEvenements / totalCount * 100.0;
        double percentagePortePrestations = (double) countPortePrestations / totalCount * 100.0;
        double percentageEvenementEtPrestation = (double) evenEtPrest / totalCount * 100.0;


        DefaultPieDataset<String> dataset = new DefaultPieDataset<>();
        dataset.setValue("Porté événements", percentagePorteEvenement);
        dataset.setValue("Porté prestations", percentagePortePrestations);
        dataset.setValue("Les deux", percentageEvenementEtPrestation);


        JFreeChart chart = ChartFactory.createPieChart("Répartition par type de client", dataset, true, true, false);
        PiePlot plot = (PiePlot) chart.getPlot();
        plot.setLabelGenerator(new StandardPieSectionLabelGenerator("{0} - {2}"));
        return chart;
    }

    private static JFreeChart createTopCustomersChart(List<Client> clients, List<Integer> dureesAbonnements) {
        Map<Client, Integer> dureesMap = new HashMap<>();

        // Associez chaque client à sa durée d'abonnement correspondante
        for (int i = 0; i < clients.size(); i++) {
            dureesMap.put(clients.get(i), dureesAbonnements.get(i));
        }

        // Triez les clients en fonction de leurs durées d'abonnement (dans l'ordre décroissant)
        List<Client> sortedClients = clients.stream()
                .sorted(Comparator.comparing(dureesMap::get, Comparator.reverseOrder()))
                .limit(5)
                .toList();

        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        // Utilisez les clients triés pour créer le graphique
        for (Client client : sortedClients) {
            int fidelite = dureesMap.get(client);
            dataset.addValue((double) fidelite, "Fidélité", client.getNom());
        }

        JFreeChart chart = ChartFactory.createBarChart(
                "Top 5 des clients les plus fidèles", "Client", "Niveau de fidélité (en mois)",
                dataset, PlotOrientation.VERTICAL, true, true, false
        );

        return chart;
    }

    private static JFreeChart createSubscriptionsChart(List<Client> clients, List<Integer> dureesAbonnements) {
        Map<String, Integer> abonnementCounts = new HashMap<>();

        // Count the number of times each abonnement has been taken
        for (Client client : clients) {
            List<Abonnement> abonnements = client.getAbonnements();
            for (Abonnement abonnement : abonnements) {
                String abonnementType = abonnement.getType();
                abonnementCounts.put(abonnementType, abonnementCounts.getOrDefault(abonnementType, 0) + 1);
            }
        }

        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        // Add the abonnement counts to the dataset
        for (String abonnementType : abonnementCounts.keySet()) {
            int count = abonnementCounts.get(abonnementType);
            dataset.addValue((double) count, "Nombre d'abonnements", abonnementType);
        }

        JFreeChart chart = ChartFactory.createBarChart(
                "Répartition des abonnements", "Abonnement", "Nombre d'abonnements",
                dataset, PlotOrientation.VERTICAL, true, true, false
        );

        return chart;
    }



    private static JFreeChart createEventTypeChart(List<Evenement> evenements) {
        DefaultPieDataset dataset = new DefaultPieDataset();

        for (Evenement evenement : evenements) {
            dataset.setValue(evenement.getType(), evenement.getDemande());
        }

        JFreeChart chart = ChartFactory.createPieChart("Répartition par type d'événement", dataset, true, true, false);
        PiePlot plot = (PiePlot) chart.getPlot();
        plot.setLabelGenerator(null);
        return chart;
    }


    private static JFreeChart createTopRequestedEventsChart(List<Evenement> allEvents) {
        List<Evenement> coursStreamEvents = allEvents.stream()
                .filter(e -> e.getType().equals("Cours/Stream collectif"))
                .collect(Collectors.toList());

        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        for (Evenement evenement : coursStreamEvents) {
            int reservationCount = evenement.getReservations().size();
            dataset.addValue(reservationCount, "Occurrences", evenement.getNom());
        }

        JFreeChart chart = ChartFactory.createBarChart(
                "Événements les plus fréquents - Cours/Stream collectif",
                "Événement", "Occurrences",
                dataset, PlotOrientation.VERTICAL, true, true, false);

        return chart;
    }

    private static JFreeChart createEventFrequencyChart(List<Evenement> evenements) {
        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        for (Evenement evenement : evenements) {
            dataset.addValue(evenement.getDemande(), "Fréquence", evenement.getNom());
        }

        JFreeChart chart = ChartFactory.createLineChart("Fréquence des événements", "Mois", "Fréquence", dataset, PlotOrientation.VERTICAL, true, true, false);
        return chart;
    }

    private static JFreeChart createTofpRequestedEventsChart(List<Evenement> evenements) {
        // Trier la liste des événements par demande décroissante
        evenements.sort(Comparator.comparingInt(Evenement::getDemande).reversed());

        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        for (int i = 0; i < 5 && i < evenements.size(); ++i) {
            Evenement evenement = evenements.get(i);
            dataset.addValue(evenement.getDemande(), "Demande", evenement.getNom());
        }

        JFreeChart chart = ChartFactory.createBarChart(
                "Top 5 des événements les plus demandés", "Événement", "Demande",
                dataset, PlotOrientation.VERTICAL, true, true, false
        );

        return chart;
    }

    private static JFreeChart createServiceTypeChart(List<Prestation> prestations) {
        DefaultPieDataset dataset = new DefaultPieDataset();

        for (Prestation prestation : prestations) {
            dataset.setValue(prestation.getType(), prestation.getNombreReservations());
        }

        JFreeChart chart = ChartFactory.createPieChart("Répartition par type de prestation", dataset, true, true, false);
        PiePlot plot = (PiePlot) chart.getPlot();
        plot.setLabelGenerator(null);
        return chart;
    }

    private static JFreeChart createServiceCostChart(List<Prestation> prestations) {
        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        for (Prestation prestation : prestations) {
            dataset.addValue(prestation.getCost(), "Coût", prestation.getType());
        }

        JFreeChart chart = ChartFactory.createBarChart("Répartition par coût de prestation", "Prestation", "Coût", dataset, PlotOrientation.VERTICAL, true, true, false);
        return chart;
    }

    //
}
