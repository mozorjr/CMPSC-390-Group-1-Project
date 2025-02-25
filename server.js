const express = require('express');
const app = express();
const dotenv = require('dotenv');
const subscriptionRoute = require('./routes/subscriptionRoute');

// Configure environment variables
dotenv.config();

// Middleware
app.use(express.json());

// Use subscription route
app.use('/api/subscription', subscriptionRoute);

// basic route
app.get('/', (req, res) => {
  res.send('Health Horizon backend is running');
});

// Start server
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
