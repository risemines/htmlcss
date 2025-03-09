nom="Yasmine";
prenom="Aibeche";
age=20;
note=16;
etudiantsTab=new Array("Etudiant1","Etudiant2","Etudiant3");
function afficherTab(){
    for (let i = 0; i < etudiantsTab.length; i++) {
      console.log(etudiantsTab[i]);
    }
}
const etudiants=[
{
  nom1: "yasmine",
  prenom1: "aibeche",
  note: 14,
},
{
  nom1: "imene",
  prenom1: "nadia",
  note: 7,
},
{
  nom1: "smail",
  prenom1: "walid",
  note: 13,
}
];
function afficherN() {
  console.log(nom);
}
function afficherP() {
  console.log(prenom);
}
function afficherA() {
  console.log(age);
}
function afficherT() {
  console.log(note);
}
function deliberation(){
  for (let i = 0; i < etudiants.length; i++) {
    if(estAdmissible(etudiants[i].note)){
      console.log("Admis");
    } else {
      console.log("Ajourne");
    }
  }

}
function estAdmissible(note){
  if (note>=10) {
    return true;
  } else {
    return false;
  }
}

const film=[
  {
    titre:"frozen",
    annee:2020,
    producteur:"indina",
  },
  {
    titre:"moana",
    annee:2021,
    producteur:"disney",
  },
  {
    titre:"ratatouille",
    annee:2023,
    producteur:"imene",
  }

];
function afficherFilm() {
  for (let i = 0; i < film.length; i++) {
    console.log(film[i]);
  }
}
function ajouterFilm(){
  const filmFictif = { titre: "XX", annee: "XX", producteur: "XX" };
  film.push(filmFictif);
  afficherFilm();
}
function supprimerFilm(){
  film.shift();
  afficherFilm();
}
