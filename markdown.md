# ECF BLOG  

Expression de besoin
Un blog pour pouvoir poster des articles avec photos et mettre des commentaires.  
Dans un premier lieu il y a la phase de Login. Le login se fait pour les membres.

### Membres actifs 
Ils vont rentrer leur mail comme username, leur mots de passes, une photo pour leur avatar, et une petite phrase sur eux même pourquoi ils sont sur ce blog.  
* Les membres peuvent Lire
* Les membres peuvent mettre un commentaire
* Les membres peuvent Liker 

Bonus : avoir leur contacts qui figure dessous leur photo, comme ça ils peuvent se connecter entre eux.  
Bonus: thème sombre/thème clair.

### Le blog est géré par un admin. 

* L’admin peut créer des postes avec des images. 
* L’admin peut modifier le poste, et l’image.
* L’admin peut enlever le poste entier.
* L’admin peut enlever des commentaires.
* L’admin peut enlever le compte d’un utilisateur.


***NOT DONE***  
Bonus: admin peut changer la photo du background. Et Changer la couleur des thèmes.

***

### Fonctionalités 
Login  
Register  
Create Post  
Update Post  
Delete Post   
Create a comment  
Add a Like  
Remove comment  
Remove all Likes before removing a member  
Remove all comments before removing a member  

### Accès restreint:  

Sur une page à part, l’Admin peut créer des articles avec des photos.   
### Accès spécial:  

Sur la même page où on liste les postes, l’admin peut modifier le poste, et l’image. l’admin peut enlever le poste entier, l’admin peut enlever des commentaires.  
Sur la page ou on visualise les membres, l’admin peut enlever le compte d’un utilisateur.  


### Arborescence
![Arborescence du blablaBlog](/asset/img/arborescenceFinal.png "Arborescence du blablaBlog")

***

### Wireframe
![Wireframe du blablaBlog](/asset/img/ECFblog.png "Wireframe du blablaBlog")



*** 

### BDD 

Dictionnaire de données

Entités : Role - Membres - Admin - Post - Like - Commentaires.  
Attribus: Email - mot de passe - photo.  
Relations: possède - lire - écrire - commenter - mettre - modifier - supprimer.   

Membre a un Email et un mot de pass et une photo de profil et une phrase de description  
Membre a un Email et un mot de pass et une photo de profil et une phrase de description  

Un admin peut Ecrire un post et ajouter une image.    
Un admin peut modifier le post et l'image.  
Un admin peut supprimer le post.  
Un admin peut supprimer les likes et les commentaires.  

Un membre peut lire les posts.  
Un membre peut mettre des commentaires.  
Un membre peut mettre un Like.  

Un role possède au minimum 0 utilisateur et au maximum N utilisateur  
Un Membre possède au minimum 1 role et au max 1 role?  
Un Membre peut mettre au minimum 0 commentaires au max N commentaires.  
Un Membre peut mettre au minimum 0 Like au max 1 Like.  
Un post possède au minimum 0 commentaires et au max N commentaires.  
Un post possède au minimum 0 commentaires et au max N Likes.  





![MCD-MLD du blablaBlog](/asset/img/520-blog-MCD-MLD.drawio.png "MCD-MLD du blablaBlog")


## Planning
![Trello](/asset/img/trello.png "Planning using Trello")

### Lundi 17-06-24
Début du projet - écrire l'expression du besoin - mettre en place l'arborescence. 

### Mardi 18-06

MCD-MLD

### Mercredi 19-06

Débur Réalisation + Git

### Jeudi 20-06

Réalisation 

### Vendredi 21-06

Réalisation 

### Lundi 24-06

Réalisation

### Mardi 25-06 

Début réalisation CSS

### Mercredi 26-06 

Réalisation

### Jeudi 27-06

Fin de réalisation css
Début du support visuel

### Vendredi 28-06

Présentation