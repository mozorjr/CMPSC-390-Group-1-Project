import os
from flask import Flask, render_template, jsonify, request
import stripe
from dotenv import load_dotenv

# Load environment variables from .env file
load_dotenv()

# Initialize Flask app
app = Flask(__name__)

# secret and publishable keys from environment variables
STRIPE_SECRET_KEY = os.getenv('STRIPE_SECRET_KEY')
STRIPE_PUBLISHABLE_KEY = os.getenv('STRIPE_PUBLISHABLE_KEY')

# Stripe with your secret key
stripe.api_key = STRIPE_SECRET_KEY

# URL to redirect after successful payment
YOUR_DOMAIN = "http://127.0.0.1:5000"  # domain when in production

# Define the product IDs for different plans
product_ids = {
    'Premium': 'prod_RpxkuJhY93sOJd',
    'Basic': 'prod_RpxigSVwlGEnyM',
    'Simple': 'prod_RpxjQLIFgwOPdo'
}

# Route to render the checkout page
@app.route('/')
def index():
    return render_template('checkout.html', publishable_key=STRIPE_PUBLISHABLE_KEY)

# Route to create a checkout session
@app.route('/create-checkout-session', methods=['POST'])
def create_checkout_session():
    try:
        # Get the selected plan from the client-side
        data = request.json
        plan = data.get('plan')

        # Check if the plan is valid
        if plan not in product_ids:
            return jsonify(error="Invalid plan"), 400

        # Create a new Stripe checkout session
        session = stripe.checkout.Session.create(
            payment_method_types=['card'],  # Payment method options (we'll use cards for now)
            line_items=[{
                'price_data': {
                    'currency': 'usd',  # Currency for the transaction
                    'product': product_ids[plan],  # Product ID from the plan
                    'unit_amount': {
                        'Premium': 3000,  # $30.00 for Premium plan
                        'Basic': 5000,    # $50.00 for Basic plan
                        'Simple': 1500    # $15.00 for Simple plan
                    }[plan],  # Amount in cents (so 3000 means $30.00)
                },
                'quantity': 1,  # Quantity for the plan (we assume 1 for now)
            }],
            mode='payment',  # Mode of payment (for a one-time payment)
            success_url=f'{YOUR_DOMAIN}/success',  # Redirect URL after successful payment
            cancel_url=f'{YOUR_DOMAIN}/cancel',    # Redirect URL if payment is canceled
        )

        # Return the session ID to the frontend for redirection
        return jsonify(id=session.id)

    except Exception as e:
        return jsonify(error=str(e)), 500

# Route for successful payment
@app.route('/success')
def success():
    return 'Payment succeeded! Thank you for subscribing.'

# Route for canceled payment
@app.route('/cancel')
def cancel():
    return 'Payment canceled. Please try again.'

# Run the Flask application
if __name__ == '__main__':
    app.run(debug=True)