import com.itextpdf.text.*;
import com.itextpdf.text.pdf.ColumnText;
import com.itextpdf.text.pdf.PdfContentByte;
import com.itextpdf.text.pdf.PdfPageEventHelper;
import com.itextpdf.text.pdf.PdfWriter;
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
    public static void generateReport(Client client,List<Client> clients) {
        Document document = new Document();

        try {
            String fileName = "C:\\Users\\emato\\OneDrive\\Bureau\\CookFusionPdf\\" + client.getNom().replaceAll("\\s+", "_") + ".pdf";
            PdfWriter writer = PdfWriter.getInstance(document, new FileOutputStream(fileName));

            document.open();

            addTitlePage(document, client);
            addClientInfoPage(document, client);
            addAbonnementsPage(document, client);
            addDevisPage(document, client);
            addFacturesPage(document, client);
            addFooter(writer);
            addClientStatisticsPage(document, clients);

            writer.setPageEvent(new PdfPageEventHelper() {
                public void onStartPage(PdfWriter writer, Document document) {
                    document.newPage();
                }
            });

            document.close();

            System.out.println("Rapport PDF généré pour le client : " + client.getNom());
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private static void addTitlePage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Rapport Cook Fusion", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 18));
        title.setAlignment(Element.ALIGN_CENTER);
        document.add(title);

        Paragraph clientInfo = new Paragraph("Rapport détaillé des activités du client : " + client.getNom(), FontFactory.getFont(FontFactory.HELVETICA, 12));
        clientInfo.setAlignment(Element.ALIGN_CENTER);
        document.add(clientInfo);

        document.add(Chunk.NEWLINE);
    }

    private static void addClientInfoPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Informations du client", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        document.add(title);

        document.add(new Paragraph("Nom du client : " + client.getNom()));
        document.add(new Paragraph("Adresse du client : " + client.getAdresse()));

        document.add(Chunk.NEWLINE);
    }

    private static void addAbonnementsPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Abonnements du client", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        document.add(title);

        List<Abonnement> abonnements = client.getAbonnements();
        for (Abonnement abonnement : abonnements) {
            document.add(new Paragraph("Type d'abonnement : " + abonnement.getType()));
            document.add(new Paragraph("Durée de l'abonnement : " + abonnement.getDuree() + " mois"));
            document.add(new Paragraph("Coût de l'abonnement : " + abonnement.getCout()));

            document.add(Chunk.NEWLINE);
        }

    }

    private static void addDevisPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Devis du client", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        document.add(title);

        List<Devis> devis = client.getDevis();
        for (Devis devisClient : devis) {
            document.add(new Paragraph("Montant du devis : " + devisClient.getMontant()));

            document.add(Chunk.NEWLINE);
        }
    }

    private static void addFacturesPage(Document document, Client client) throws DocumentException {
        Paragraph title = new Paragraph("Factures du client", FontFactory.getFont(FontFactory.HELVETICA_BOLD, 14));
        document.add(title);

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
        document.add(title);

        // Répartition par CA
        JFreeChart revenueChart = createRevenueChart(clients);
        addChartToDocument(document, revenueChart);

        // Répartition par type de client
        JFreeChart clientTypeChart = createClientTypeChart(clients);
        addChartToDocument(document, clientTypeChart);

        // Régularité d'achat
        JFreeChart purchaseFrequencyChart = createPurchaseFrequencyChart(clients);
        addChartToDocument(document, purchaseFrequencyChart);

        // Top 5 des clients les plus fidèles
        JFreeChart topCustomersChart = createTopCustomersChart(clients);
        addChartToDocument(document, topCustomersChart);
    }

    private static void addChartToDocument(Document document, JFreeChart chart) throws DocumentException, IOException {
        // Convertit le graphique en une image
        ByteArrayOutputStream chartImage = new ByteArrayOutputStream();
        ChartUtils.writeChartAsPNG(chartImage, chart, 500, 300);

        // Ajoute l'image au document PDF
        Image image = Image.getInstance(chartImage.toByteArray());
        image.setAlignment(Element.ALIGN_CENTER);
        document.add(image);

        // Ajoute un espace vertical
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

}
