// server.js

const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const expressJwt = require('express-jwt');
const expressValidator = require('express-validator');

const app = express();

// Connexion à la base de données MongoDB
mongoose.connect('mongodb://localhost:27017/zooDB', { useNewUrlParser: true, useUnifiedTopology: true });
const User = mongoose.model('User', { email: String, password: String, role: String });

// Middleware pour parser les données JSON
app.use(bodyParser.json());
// Middleware pour la validation des données
app.use(expressValidator());

// Middleware pour protéger les routes avec JWT
app.use(expressJwt({ secret: 'secret_key' }).unless({ path: ['/login'] }));

// Route pour l'inscription d'un nouvel utilisateur
app.post('/register', async (req, res) => {
    try {
        // Validation des données
        req.checkBody('email', 'Email invalide').isEmail();
        req.checkBody('password', 'Le mot de passe doit contenir au moins 6 caractères').isLength({ min: 6 });
        const errors = req.validationErrors();
        if (errors) {
            return res.status(400).json({ errors: errors });
        }

        // Vérifier si l'utilisateur existe déjà
        const existingUser = await User.findOne({ email: req.body.email });
        if (existingUser) {
            return res.status(400).json({ message: 'Cet utilisateur existe déjà' });
        }

        // Hasher le mot de passe
        const hashedPassword = await bcrypt.hash(req.body.password, 10);

        // Créer un nouvel utilisateur
        const newUser = new User({ email: req.body.email, password: hashedPassword, role: 'user' });
        await newUser.save();
        
        return res.status(201).json({ message: 'Utilisateur enregistré avec succès' });
    } catch (error) {
        return res.status(500).json({ message: 'Erreur lors de l\'inscription' });
    }
});

// Route pour la connexion d'un utilisateur
app.post('/login', async (req, res) => {
    try {
        // Vérifier si l'utilisateur existe
        const user = await User.findOne({ email: req.body.email });
        if (!user) {
            return res.status(401).json({ message: 'Email ou mot de passe incorrect' });
        }

        // Vérifier le mot de passe
        const passwordMatch = await bcrypt.compare(req.body.password, user.password);
        if (!passwordMatch) {
            return res.status(401).json({ message: 'Email ou mot de passe incorrect' });
        }

        // Générer un token JWT
        const token = jwt.sign({ userId: user._id, role: user.role }, 'secret_key', { expiresIn: '1h' });
        
        return res.status(200).json({ token: token });
    } catch (error) {
        return res.status(500).json({ message: 'Erreur lors de la connexion' });
    }
});

// Route protégée pour récupérer des données sensibles
app.get('/protected', (req, res) => {
    res.status(200).json({ message: 'Données sensibles accessibles uniquement avec un token valide' });
});

// Démarrage du serveur
app.listen(3000, () => {
    console.log('Serveur démarré sur le port 3000');
});
