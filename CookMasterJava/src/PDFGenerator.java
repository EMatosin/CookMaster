import com.itextpdf.text.*;
import com.itextpdf.text.pdf.*;
import org.jfree.chart.ChartFactory;
import org.jfree.chart.ChartUtils;
import org.jfree.chart.JFreeChart;
import org.jfree.chart.plot.PiePlot;
import org.jfree.chart.plot.PlotOrientation;
import org.jfree.data.category.DefaultCategoryDataset;
import org.jfree.data.general.DefaultPieDataset;

import java.io.ByteArrayOutputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.List;


public class PDFGenerator {
    public static void generateReport(List<Client> clients, List<Evenement> evenements,List<Prestation> prestations ) {
        Document document = new Document();

        try {
            String fileName = "C:\\Users\\emato\\OneDrive\\Bureau\\CookFusionPdf\\rapport.pdf";
            PdfWriter writer = PdfWriter.getInstance(document, new FileOutputStream(fileName));

            document.open();
            addTitlePage(document);
            document.add(Chunk.NEWLINE);

            for (Client client : clients) {
                addTitlePageClient(document,client);
                addClientInfoPage(document, client);
                addAbonnementsPage(document, client);
                addDevisPage(document, client);
                addFacturesPage(document, client);
                addFooter(writer);
                document.newPage();
            }

            addClientStatisticsPage(document, clients);
            addFooter(writer);
            document.newPage();

            addEventStatisticsPage(document, evenements);
            addFooter(writer);
            document.newPage();

            addServiceStatisticsPage(document, prestations);
            addFooter(writer);
            document.newPage();

            document.close();

            System.out.println("Rapport PDF généré avec succès.");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private static void addTitlePage(Document document) throws DocumentException {
        Paragraph title = new Paragraph("Rapport détaillé des activités sur Cook Fusion", FontFactory.getFont(FontFactory.HELVETICA_OBLIQUE, 15));
        title.setAlignment(Element.ALIGN_CENTER);
        document.add(title);

        document.add(Chunk.NEWLINE);
    }

    private static void addTitlePageClient(Document document,Client client) throws DocumentException {
        Paragraph title = new Paragraph("Détail du compte au nom de : "+ client.getNom() , FontFactory.getFont(FontFactory.HELVETICA_BOLD, 18));
        title.setAlignment(Element.ALIGN_CENTER);
        document.add(title);

        document.add(Chunk.NEWLINE);
    }

    private static void addClientInfoPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Informations du client", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        document.add(title);
        document.add(Chunk.NEWLINE);


        document.add(new Paragraph("Nom du client : " + client.getNom()));
        document.add(new Paragraph("Adresse du client : " + client.getAdresse()));

        document.add(Chunk.NEWLINE);
    }


    private static void addAbonnementsPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Abonnements du client", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        document.add(title);
        document.add(Chunk.NEWLINE);


        List<Abonnement> abonnements = client.getAbonnements();
        for (Abonnement abonnement : abonnements) {
            document.add(new Paragraph("Type d'abonnement : " + abonnement.getType()));
            document.add(new Paragraph("Date de début : " + abonnement.getDateDebut()));
            document.add(new Paragraph("Durée de l'abonnement : " + abonnement.getDuree() + " mois"));
            document.add(new Paragraph("Coût de l'abonnement : " + abonnement.getCout()));

            document.add(Chunk.NEWLINE);
        }

    }

    private static void addDevisPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Devis du client", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        document.add(title);
        document.add(Chunk.NEWLINE);


        List<Devis> devis = client.getDevis();
        for (Devis devisClient : devis) {
            document.add(new Paragraph("Montant du devis : " + devisClient.getMontant()));

            document.add(Chunk.NEWLINE);
        }
    }

    private static void addFacturesPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Factures du client", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        document.add(title);
        document.add(Chunk.NEWLINE);


        List<Facture> factures = client.getFactures();
        for (Facture facture : factures) {
            document.add(new Paragraph("Montant de la facture : " + facture.getMontant()));

            document.add(Chunk.NEWLINE);
        }
    }

    private static void addFooter(PdfWriter writer) throws DocumentException, IOException {
        PdfContentByte cb = writer.getDirectContent();

        // Ajoutez le logo
        Image logo = Image.getInstance("C:\\Users\\emato\\OneDrive\\Bureau\\CookFusionPdf\\aklogo.png");
        logo.scaleToFit(80, 80);
        logo.setAbsolutePosition((writer.getPageSize().getWidth() - logo.getScaledWidth()) / 2, 40);
        cb.addImage(logo);

        // Ajoutez le commentaire
        Phrase phrase = new Phrase("Délivré par CookFusion - Votre partenaire culinaire de confiance pour des expériences gastronomiques uniques.", FontFactory.getFont(FontFactory.HELVETICA, 10));
        ColumnText.showTextAligned(cb, Element.ALIGN_CENTER, phrase, writer.getPageSize().getWidth() / 2, 20, 0);
    }

    private static void addClientStatisticsPage(Document document, List<Client> clients) throws DocumentException, IOException {
        Paragraph title = new Paragraph("Statistiques des comptes clients", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        title.setAlignment(Element.ALIGN_CENTER);
        document.add(title);
        document.add(Chunk.NEWLINE);

        JFreeChart revenueChart = createRevenueChart(clients);
        addChartToDocument(document, revenueChart);

        JFreeChart clientTypeChart = createClientTypeChart(clients);
        addChartToDocument(document, clientTypeChart);

        JFreeChart purchaseFrequencyChart = createPurchaseFrequencyChart(clients);
        addChartToDocument(document, purchaseFrequencyChart);

        JFreeChart topCustomersChart = createTopCustomersChart(clients);
        addChartToDocument(document, topCustomersChart);

        document.newPage();
    }

    private static void addEventStatisticsPage(Document document, List<Evenement> evenements) throws DocumentException, IOException {
        Paragraph title = new Paragraph("Statistiques des événements", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        title.setAlignment(Element.ALIGN_CENTER);
        document.add(title);
        document.add(Chunk.NEWLINE);

        JFreeChart eventTypesChart = createEventTypeChart(evenements);
        addChartToDocument(document, eventTypesChart);

        JFreeChart eventFrequencyChart = createEventFrequencyChart(evenements);
        addChartToDocument(document, eventFrequencyChart);

        JFreeChart topRequestedEventsChart = createTopRequestedEventsChart(evenements);
        addChartToDocument(document, topRequestedEventsChart);

        document.newPage();
    }

    private static void addServiceStatisticsPage(Document document, List<Prestation> prestations) throws DocumentException, IOException {
        Paragraph title = new Paragraph("Statistiques des prestations", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        title.setAlignment(Element.ALIGN_CENTER);
        document.add(title);
        document.add(Chunk.NEWLINE);

        JFreeChart serviceTypesChart = createServiceTypeChart(prestations);
        addChartToDocument(document, serviceTypesChart);

        JFreeChart serviceCostChart = createServiceCostChart(prestations);
        addChartToDocument(document, serviceCostChart);

        JFreeChart serviceEventsCountChart = createTopFrequentServicesChart(prestations);
        addChartToDocument(document, serviceEventsCountChart);

    }

    private static void addChartToDocument(Document document, JFreeChart chart) throws DocumentException, IOException {
        ByteArrayOutputStream chartImage = new ByteArrayOutputStream();
        ChartUtils.writeChartAsPNG(chartImage, chart, 500, 150);

        Image image = Image.getInstance(chartImage.toByteArray());
        image.setAlignment(Element.ALIGN_CENTER);

        document.add(image);

        document.add(Chunk.NEWLINE);
    }

    private static JFreeChart createRevenueChart(List<Client> clients) {
        DefaultPieDataset dataset = new DefaultPieDataset();

        // Calculer la répartition par CA (exemple)
        // Remplacez cette logique avec vos propres données
        dataset.setValue("CA 1", 1000);
        dataset.setValue("CA 2", 2000);
        dataset.setValue("CA 3", 1500);
        dataset.setValue("CA 4", 3000);

        JFreeChart chart = ChartFactory.createPieChart("Répartition par CA", dataset, true, true, false);
        PiePlot plot = (PiePlot) chart.getPlot();
        plot.setLabelGenerator(null); // Masquer les étiquettes

        return chart;
    }

    private static JFreeChart createClientTypeChart(List<Client> clients) {
        DefaultPieDataset dataset = new DefaultPieDataset();

        // Calculer la répartition par type de client (exemple)
        // Remplacez cette logique avec vos propres données
        dataset.setValue("Type 1", 25);
        dataset.setValue("Type 2", 30);
        dataset.setValue("Type 3", 20);
        dataset.setValue("Type 4", 15);

        JFreeChart chart = ChartFactory.createPieChart("Répartition par type de client", dataset, true, true, false);
        PiePlot plot = (PiePlot) chart.getPlot();
        plot.setLabelGenerator(null); // Masquer les étiquettes

        return chart;
    }

    private static JFreeChart createPurchaseFrequencyChart(List<Client> clients) {
        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        // Calculer la régularité d'achat (exemple)
        // Remplacez cette logique avec vos propres données
        dataset.addValue(10, "Fréquence", "Janvier");
        dataset.addValue(15, "Fréquence", "Février");
        dataset.addValue(12, "Fréquence", "Mars");
        dataset.addValue(8, "Fréquence", "Avril");
        dataset.addValue(5, "Fréquence", "Mai");
        dataset.addValue(20, "Fréquence", "Juin");

        JFreeChart chart = ChartFactory.createLineChart("Régularité d'achat", "Mois", "Fréquence", dataset, PlotOrientation.VERTICAL, true, true, false);

        return chart;
    }

    private static JFreeChart createTopCustomersChart(List<Client> clients) {
        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        // Calculer le top 5 des clients les plus fidèles (exemple)
        // Remplacez cette logique avec vos propres données
        for (int i = 0; i < 5 && i < clients.size(); i++) {
            Client client = clients.get(i);
            dataset.addValue(client.getFidelite(), "Fidélité", client.getNom());
        }

        JFreeChart chart = ChartFactory.createBarChart("Top 5 des clients les plus fidèles", "Client", "Fidélité", dataset, PlotOrientation.VERTICAL, true, true, false);

        return chart;
    }

    private static JFreeChart createEventTypeChart(List<Evenement> evenements) {
        DefaultPieDataset dataset = new DefaultPieDataset();

        // Calculer la répartition par type d'événement (exemple)
        // Remplacez cette logique avec vos propres données
        dataset.setValue("Type 1", 25);
        dataset.setValue("Type 2", 30);
        dataset.setValue("Type 3", 20);
        dataset.setValue("Type 4", 15);

        JFreeChart chart = ChartFactory.createPieChart("Répartition par type d'événement", dataset, true, true, false);
        PiePlot plot = (PiePlot) chart.getPlot();
        plot.setLabelGenerator(null); // Masquer les étiquettes

        return chart;
    }

    private static JFreeChart createEventFrequencyChart(List<Evenement> evenements) {
        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        // Calculer la fréquence des événements (exemple)
        // Remplacez cette logique avec vos propres données
        dataset.addValue(10, "Fréquence", "Janvier");
        dataset.addValue(15, "Fréquence", "Février");
        dataset.addValue(12, "Fréquence", "Mars");
        dataset.addValue(8, "Fréquence", "Avril");
        dataset.addValue(5, "Fréquence", "Mai");
        dataset.addValue(20, "Fréquence", "Juin");

        JFreeChart chart = ChartFactory.createLineChart("Fréquence des événements", "Mois", "Fréquence", dataset, PlotOrientation.VERTICAL, true, true, false);

        return chart;
    }

    private static JFreeChart createTopRequestedEventsChart(List<Evenement> evenements) {
        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        // Calculer le top 5 des événements les plus demandés (exemple)
        // Remplacez cette logique avec vos propres données
        for (int i = 0; i < 5 && i < evenements.size(); i++) {
            Evenement evenement = evenements.get(i);
            dataset.addValue(evenement.getDemande(), "Demande", evenement.getNom());
        }

        JFreeChart chart = ChartFactory.createBarChart("Top 5 des événements les plus demandés", "Événement", "Demande", dataset, PlotOrientation.VERTICAL, true, true, false);

        return chart;
    }

    private static JFreeChart createServiceTypeChart(List<Prestation> prestations) {
        DefaultPieDataset dataset = new DefaultPieDataset();

        // Calculer la répartition par type de prestation (exemple)
        // Remplacez cette logique avec vos propres données
        dataset.setValue("Type 1", 25);
        dataset.setValue("Type 2", 30);
        dataset.setValue("Type 3", 20);
        dataset.setValue("Type 4", 15);

        JFreeChart chart = ChartFactory.createPieChart("Répartition par type de prestation", dataset, true, true, false);
        PiePlot plot = (PiePlot) chart.getPlot();
        plot.setLabelGenerator(null); // Masquer les étiquettes

        return chart;
    }

    private static JFreeChart createServiceCostChart(List<Prestation> prestations) {
        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        // Calculer la répartition par coût de prestation (exemple)
        // Remplacez cette logique avec vos propres données
        for (Prestation prestation : prestations) {
            dataset.addValue(prestation.getCout(), "Coût", prestation.getNom());
        }

        JFreeChart chart = ChartFactory.createBarChart("Répartition par coût de prestation", "Prestation", "Coût", dataset, PlotOrientation.VERTICAL, true, true, false);

        return chart;
    }

    private static JFreeChart createTopFrequentServicesChart(List<Prestation> prestations) {
        DefaultCategoryDataset dataset = new DefaultCategoryDataset();

        // Calculer le top 5 des prestations les plus fréquentes (exemple)
        // Remplacez cette logique avec vos propres données
        for (int i = 0; i < 5 && i < prestations.size(); i++) {
            Prestation prestation = prestations.get(i);
            dataset.addValue(prestation.getFrequence(), "Fréquence", prestation.getNom());
        }

        JFreeChart chart = ChartFactory.createBarChart("Top 5 des prestations les plus fréquentes", "Prestation", "Fréquence", dataset, PlotOrientation.VERTICAL, true, true, false);

        return chart;
    }


}
