const express = require('express');
const router = express.Router();
const Stripe = require('stripe');
const dotenv = require('dotenv');

// Load environment variables
dotenv.config();

const stripe = Stripe(process.env.sk_test_51QwFvuEOlUKfbOjhUeqB5HU7AYrXCm3U7AbkkEpyEyZsIiThBvjqMVtxb3lJPwvPzL6odc6EuarEpWymijuxmuuh00mQ4n13qt);

// Route to handle subscription creation
router.post('/create-subscription', async (req, res) => {
  const { paymentMethodId, plan } = req.body; // assuming plan is passed in request body (basic, advanced, pro)

  try {
    // Create a customer (if not already created)
    const customer = await stripe.customers.create({
      payment_method: paymentMethodId,
      invoice_settings: { default_payment_method: paymentMethodId },
    });

    // Define the price for each plan
    let price;
    if (plan === 'basic') {
      price = 50; // Price for Basic plan ($50)
    } else if (plan === 'advanced') {
      price = 75; // Price for Advanced plan ($75)
    } else if (plan === 'pro') {
      price = 100; // Price for Pro plan ($100)
    } else {
      return res.status(400).send({ error: { message: "Invalid plan selected" } });
    }

    // Create a subscription with the chosen plan price
    const subscription = await stripe.subscriptions.create({
      customer: customer.id,
      items: [
        {
          price_data: {
            currency: 'usd', // Currency for the price (USD in this case)
            product_data: {
              name: `${plan} Plan`, // Name of the plan (Basic, Advanced, Pro)
            },
            unit_amount: price * 100, // Stripe expects the amount in cents
          },
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
