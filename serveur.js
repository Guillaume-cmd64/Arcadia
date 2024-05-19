// server.js
const express = require("express");
const bodyParser = require("body-parser");
const mongoose = require("mongoose");

const app = express();

// Connexion à la base de données MongoDB
mongoose.connect("mongodb://localhost:27017/zooDB", { useNewUrlParser: true, useUnifiedTopology: true });
const Habitat = mongoose.model("Habitat", { nom: String, consultations: Number });

// Middleware pour parser les données JSON
app.use(bodyParser.json());

// Route pour récupérer les données des habitats
app.get("/habitats", async (req, res) => {
    const habitats = await Habitat.find();
    res.json(habitats);
});

// Route pour incrémenter le compteur de consultation d'un habitat
app.post("/consult", async (req, res) => {
    const habitatId = req.body.habitatId;
    await Habitat.findByIdAndUpdate(habitatId, { $inc: { consultations: 1 } });
    res.send("Consultation enregistrée.");
});

// Démarrage du serveur
app.listen(3000, () => {
    console.log("Serveur démarré sur le port 3000");
});
