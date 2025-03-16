from flask import Flask, render_template

app = Flask(__name__, template_folder="front-end/code")

@app.route("/")
def home():
    return render_template("index.html")  # Change this if your main file is different

@app.route("/member.html")
def member():
    return render_template("member.html")

@app.route("/index.html")
def index():
    return render_template("index.html")


if __name__ == "__main__":
    app.run(debug=True)
