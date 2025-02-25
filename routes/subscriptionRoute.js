const express = require('express');
const router = express.Router();
const Stripe = require('stripe');
const dotenv = require('dotenv');

// Load environment variables
dotenv.config();

// Initialize Stripe with your secret key from .env
const stripe = Stripe(process.env.sk_test_51QwFvuEOlUKfbOjhUeqB5HU7AYrXCm3U7AbkkEpyEyZsIiThBvjqMVtxb3lJPwvPzL6odc6EuarEpWymijuxmuuh00mQ4n13qt); // Securely load Stripe secret key

// Route to handle subscription creation
router.post('/create-subscription', async (req, res) => {
  const { paymentMethodId, plan, email } = req.body;

  try {
    // Check if the customer already exists
    let customer = await stripe.customers.list({ email });
    if (customer.data.length === 0) {
      customer = await stripe.customers.create({
        email: email,
        payment_method: paymentMethodId,
        invoice_settings: { default_payment_method: paymentMethodId },
      });
    } else {
      customer = customer.data[0]; // Use existing customer
    }

    // Define the Stripe Price ID for each plan dynamically
    let priceId;
    if (plan === 'basic') {
      priceId = price_1QwTfcEOlUKfbOjhfkAzDE7b; // Replace with actual price ID for basic plan
    } else if (plan === 'advanced') {
      priceId = price_1QwTftEOlUKfbOjhiXujD1zb; // Replace with actual price ID for advanced plan
    } else if (plan === 'pro') {
      priceId = price_1QwTgDEOlUKfbOjhO2ClVqVV; // Replace with actual price ID for pro plan
    } else {
      return res.status(400).send({ error: { message: "Invalid plan selected" } });
    }

    // Create a subscription with the chosen price ID
    const subscription = await stripe.subscriptions.create({
      customer: customer.id,
      items: [
        {
          price: priceId,  // Reference the Stripe Price ID here
        },
      ],
      expand: ['latest_invoice.payment_intent'],
    });

    res.status(200).send(subscription);
  } catch (error) {
    console.error('Error creating subscription:', error);
    res.status(400).send({ error: { message: error.message } });
  }
});

// Export the router
module.exports = router;
