# 📸 PhotoSphere – Galerie Photo Communautaire

## 🧠 Présentation du projet
PhotoSphere est une application web de galerie photo communautaire développée pour permettre aux photographes amateurs et professionnels de partager leurs photos, créer des albums et interagir entre eux, sans la complexité des réseaux sociaux classiques.

Ce projet a été réalisé dans un contexte académique en respectant des règles métier précises (gestion des rôles, sécurité, intégrité des données).

---

## 🎯 Objectifs du projet
- Permettre le partage de photos en ligne
- Organiser les photos en albums publics ou privés
- Gérer plusieurs types d’utilisateurs avec des permissions différentes
- Assurer la sécurité et la cohérence des données
- Offrir des interactions simples (likes, commentaires)

---

## 👥 Types d’utilisateurs

### 🔹 BasicUser (Photographe amateur)
- Upload limité à 10 photos par mois
- Création d’albums publics uniquement
- Peut commenter et liker les photos des autres utilisateurs

### 🔹 ProUser (Photographe professionnel)
- Upload illimité de photos
- Création d’albums publics et privés
- Accès aux statistiques (vues, likes, etc.)

### 🔹 Moderator
- Supprime les commentaires inappropriés
- Désactive temporairement des comptes
- Toutes les actions sont enregistrées dans un journal d’audit

### 🔹 Administrator
- Gestion complète de la plateforme
- Gestion des utilisateurs et des statistiques globales
- Accès aux paramètres système (super-admin)

---

## 🖼️ Gestion des photos
- Chaque photo contient des métadonnées (titre, description, taille, type MIME, dimensions)
- Cycle de vie d’une photo :
  - **Brouillon**
  - **Publiée**
  - **Archivée**
- Une photo appartient à un seul utilisateur
- Une photo peut être dans plusieurs albums
- Une photo peut avoir plusieurs tags

---

## 📁 Gestion des albums
- Un album appartient à un utilisateur
- Contient entre **1 et 100 photos**
- Peut être **public** ou **privé**
- La suppression d’un album ne supprime pas les photos

---

## 🏷️ Gestion des tags
- Les tags servent à catégoriser les photos
- Normalisation pour éviter les doublons
- Relation **many-to-many** entre Photo et Tag

---

## 💬 Commentaires et 👍 Likes
- Un utilisateur ne peut pas commenter sa propre photo
- Les commentaires peuvent avoir des réponses
- Un utilisateur ne peut liker une photo qu’une seule fois

---

## 🔐 Sécurité
- Mots de passe hashés avec bcrypt
- Validation côté serveur obligatoire
- Protection contre les injections SQL et XSS

---

## 🧩 Modélisation
- Héritage : `Utilisateur` → `BasicUser`, `ProUser`, `Moderator`, `Administrator`
- Relations :
  - BasicUser / ProUser → Photos, Albums
  - Tous les utilisateurs → Commentaires, Likes
- Classes porteuses :
  - `PhotoAlbum`
  - `PhotoTag`

---

## 🛠️ Technologies utilisées
- Backend : PHP / Java (selon implémentation)
- Base de données : MySQL
- Modélisation : UML
- Sécurité : bcrypt, validation serveur

---

## 📌 Conclusion
PhotoSphere est une plateforme structurée, sécurisée et évolutive qui met en avant une gestion claire des rôles et des contenus multimédias. Le projet respecte les bonnes pratiques de conception orientée objet et de modélisation UML.
