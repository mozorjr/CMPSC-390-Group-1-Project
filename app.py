from flask import Flask, request, jsonify, render_template
import stripe

app = Flask(__name__)

# Set your secret key. Remember to switch to your live secret key in production!
# See your keys here: https://dashboard.stripe.com/apikeys
stripe.api_key = 'sk_test_51QwFvuEOlUKfbOjhUeqB5HU7AYrXCm3U7AbkkEpyEyZsIiThBvjqMVtxb3lJPwvPzL6odc6EuarEpWymijuxmuuh00mQ4n13qt'

@app.route("/")
def home():
    return "Hello World!"

@app.route("/checkout")
def checkout():
    return render_template('checkout.html')

@app.route("/create-checkout-session", methods=["POST"])
def create_checkout_session():
    try:
        # Create a new Stripe Checkout Session for the subscription
        session = stripe.checkout.Session.create(
            payment_method_types=['card'],
            line_items=[
                {
                    'price': 'prod_Rq9za5gMc2rjel', 
                    'quantity': 1,
                },
                {
                    'price': 'prod_Rq9zKBjskUPxvb',  
                    'quantity': 1,
                },
                {
                    'price': 'prod_RqA0ZWG43Incjs',  
                    'quantity': 1,
                }
            ],
            mode='subscription',
            success_url='http://localhost:5000/success',
            cancel_url='http://localhost:5000/cancel',
        )
        return jsonify({'id': session.id})
    except Exception as e:
        return jsonify(error=str(e)), 403

@app.route("/success")
def success():
    return "Subscription successful!"

@app.route("/cancel")
def cancel():
    return "Subscription cancelled."

if __name__ == "__main__":
    app.run(debug=True)