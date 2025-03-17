import os
from flask import Flask, render_template, jsonify, request
import stripe
from dotenv import load_dotenv

# Load environment variables from .env file
load_dotenv()

# Initialize Flask app
app = Flask(__name__, template_folder="front-end/code")

# secret and publishable keys from environment variables
STRIPE_SECRET_KEY = os.getenv('STRIPE_SECRET_KEY')
STRIPE_PUBLISHABLE_KEY = os.getenv('STRIPE_PUBLISHABLE_KEY')

# Stripe secret key
stripe.api_key = STRIPE_SECRET_KEY

# URL to redirect after successful payment
YOUR_DOMAIN = "http://127.0.0.1:5000"  # domain when in production

# Define the product IDs for different plans
product_ids = {
    'Premium': 'prod_Rxcuy5W8D4Pimf',
    'Basic': 'prod_RxcpPLhBRk45cs',
    'Simple': 'prod_RxcsN6qkIjlGcA'
}

# Route to render the checkout page
@app.route('/purchase.html')
def index():
    return render_template('checkout.html', publishable_key=STRIPE_PUBLISHABLE_KEY)

# Route for the home page
@app.route("/")
def home():
    return render_template("index.html") 

# Route for "About" page
@app.route("/about.html")
def about():
    return render_template("about.html")

# Route for "Memberships" page
@app.route("/member.html")
def member():
    return render_template("member.html")

# Route for "Request a Trainer" page
@app.route("/RT.html")
def request_trainer():
    return render_template("RT.html")

# Route for "Why Us" page
@app.route("/whyUs.html")
def why_us():
    return render_template("whyUs.html")

# Route for "Contact Us" page
@app.route("/contact.html")
def contact():
    return render_template("contact.html")

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
                        'Premium': 2999,  # $29.99 for Premium plan
                        'Basic': 999,    # $9.99 for Basic plan
                        'Simple': 1999    # $19.99 for Simple plan
                    }[plan],  # Amount in cents (so 3000 means $30.00)
                },
                'quantity': 1,  # Quantity for the plan 
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
    return 'Payment succeeded! Thank you for your subscription.'

# Route for canceled payment
@app.route('/cancel')
def cancel():
    return 'Payment canceled. Please try again!'

# Run the Flask application
if __name__ == '__main__':
    app.run(debug=True)