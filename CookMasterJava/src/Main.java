//
// Source code recreated from a .class file by IntelliJ IDEA
// (powered by FernFlower decompiler)
//

import java.util.List;
import javafx.application.Application;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;

public class Main extends Application {
    public Main() {
    }

    public static void main(String[] args) {
        launch(args);
    }

    public void start(Stage primaryStage) {
        primaryStage.setTitle("Application JavaFX");
        Button generateButton = new Button("Générer le rapport PDF");
        generateButton.setOnAction((event) -> {
            List<Client> clients = RandomDataGenerator.generateRandomClients(30);

            for (Client client : clients) {
                List<Prestation> prestations = RandomDataGenerator.generateRandomPrestations();
                List<Evenement> events = RandomDataGenerator.generateRandomEvenement();
                List<Abonnement> abonnements = RandomDataGenerator.generateRandomAbonnements();
                client.setEvenements(events);
                client.setPrestations(prestations);
                client.setAbonnements(abonnements);
                List<Facture> factures = RandomDataGenerator.generateRandomFactures(abonnements, events, prestations);
                client.setFactures(factures);
            }

            PDFGenerator.generateReport(clients);
        });
        StackPane root = new StackPane();
        root.getChildren().add(generateButton);
        Scene scene = new Scene(root, 300.0, 200.0);
        primaryStage.setScene(scene);
        primaryStage.show();
    }
}
