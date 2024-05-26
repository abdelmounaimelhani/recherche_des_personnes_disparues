import mysql.connector
from mysql.connector import Error

def select_from_database():
    try:
        # Configurer les paramètres de connexion
        connection = mysql.connector.connect(
            host='localhost',      # Remplacez par le nom d'hôte de votre serveur MySQL
            database='project', # Remplacez par le nom de votre base de données
            user='root',  # Remplacez par votre nom d'utilisateur MySQL
            password='123456789' # Remplacez par votre mot de passe MySQL
        )

        if connection.is_connected():
            print("Connexion réussie à la base de données MySQL")
            
            # Créer un curseur et exécuter une requête SELECT
            cursor = connection.cursor()
            select_query = "SELECT * FROM disparu"  # Remplacez par le nom de votre table
            cursor.execute(select_query)
            
            # Récupérer tous les résultats de la requête
            records = cursor.fetchall()
            
            print("Total des lignes sélectionnées : ", cursor.rowcount)
            print("\nAffichage des résultats :")
            
            for row in records:
                print(row)

    except Error as e:
        print("Erreur lors de la connexion à MySQL ou de l'exécution de la requête", e)
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()
            print("La connexion MySQL est fermée")

# Appeler la fonction pour se connecter à la base de données et effectuer la sélection
select_from_database()
