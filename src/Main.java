import javafx.application.Application;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import java.util.ArrayList;
import java.util.List;

public class Main extends Application {
    public static void main(String[] args) {
        launch(args);
    }

    public void start(Stage primaryStage) {
        primaryStage.setTitle("Application JavaFX");

        // Création des éléments de l'interface graphique
        Label labelClients = new Label("Nombre de clients :");
        TextField textFieldClients = new TextField();
        Label labelPremium = new Label("Nouveau prix Premium :");
        TextField textFieldPremium = new TextField();
        Label labelPro = new Label("Nouveau prix Pro :");
        TextField textFieldPro = new TextField();
        Label labelStandard = new Label("Nouveau prix Standard :");
        TextField textFieldStandard = new TextField();
        Button generateButton = new Button("Générer le rapport PDF");

        // Gestion de l'événement lors du clic sur le bouton
        generateButton.setOnAction(event -> {
            // Récupération des valeurs saisies dans les champs de texte
            int numClients = Integer.parseInt(textFieldClients.getText());
            int newPricePremium = Integer.parseInt(textFieldPremium.getText());
            int newPricePro = Integer.parseInt(textFieldPro.getText());
            int newPriceStandard = Integer.parseInt(textFieldStandard.getText());

            // Modification des prix des abonnements
            Abonnement.setPrixAbonnement("Premium", newPricePremium);
            Abonnement.setPrixAbonnement("Pro", newPricePro);
            Abonnement.setPrixAbonnement("Standard", newPriceStandard);

            // Génération des clients aléatoires avec le nombre spécifié
            List<Client> clients = RandomDataGenerator.generateRandomClients(numClients);
            List<Evenement> allEvents = new ArrayList<>();

            // Reste du code pour la génération du rapport PDF
            for (Client client : clients) {
                List<Prestation> prestations = RandomDataGenerator.generateRandomPrestations();
                List<Evenement> events = RandomDataGenerator.generateRandomEvenement();
                List<Abonnement> abonnements = RandomDataGenerator.generateRandomAbonnements();

                client.setEvenements(events);
                client.setPrestations(prestations);
                client.setAbonnements(abonnements);

                List<Facture> factures = RandomDataGenerator.generateRandomFactures(abonnements, events, prestations);
                client.setFactures(factures);

                allEvents.addAll(events);
            }

            PDFGenerator.generateReport(clients, allEvents);
        });

        // Création de la mise en page de l'interface graphique
        VBox root = new VBox(
                labelClients, textFieldClients,
                labelPremium, textFieldPremium,
                labelPro, textFieldPro,
                labelStandard, textFieldStandard,
                generateButton);
        Scene scene = new Scene(root, 300, 200);

        primaryStage.setScene(scene);
        primaryStage.show();
    }
}
