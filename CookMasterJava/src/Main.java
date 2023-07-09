import java.util.List;

import javafx.application.Application;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;

public class Main extends Application {
    public static void main(String[] args) {
        launch(args);
    }

    @Override
    public void start(Stage primaryStage) {
        primaryStage.setTitle("Application JavaFX");

        Button generateButton = new Button("Générer le rapport PDF");
        generateButton.setOnAction(event -> {
            // Génération de clients aléatoires
            List<Client> clients = RandomDataGenerator.generateRandomClients(30);

            for (Client client : clients) {
                List<Prestation> prestations = RandomDataGenerator.generateRandomPrestations();
                List<Evenement> events = RandomDataGenerator.generateRandomEvenement();
                client.setEvenements(events);
                client.setPrestations(prestations);
                client.setAbonnements(RandomDataGenerator.generateRandomAbonnements());
                client.setFactures(RandomDataGenerator.generateRandomFactures());
            }

            // Génération du rapport PDF pour l'ensemble des clients
            PDFGenerator.generateReport(clients);
        });

        StackPane root = new StackPane();
        root.getChildren().add(generateButton);

        Scene scene = new Scene(root, 300, 200);
        primaryStage.setScene(scene);
        primaryStage.show();
    }
}
