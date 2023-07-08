from flask import Flask,render_template, session, redirect, url_for,request, send_from_directory
import os
import mysql.connector 
app=Flask(__name__)
app.config['TEMPLATES_AUTO_RELOAD'] = True
app.template_folder = os.path.abspath('templates')
app.config['SECRET_KEY'] = 'your_secret_key_here'
db=mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="cart"
)


@app.route('/')
def home():
    return render_template('log.html')


@app.route('/about')
def about():
    return "this is about page"
@app.route('/register')
def register():
    return render_template('register.html')


@app.route('/ins',methods=['POST','GET'])
def ins():
    name = request.form['name']
    email = request.form['email']
    password = request.form['password']
    cursor = db.cursor()
    cursor.execute("select * from usr where name=%s and email=%s and password=%s",(name,email,password))
    cart_data = cursor.fetchall()
    
    
    if len(cart_data) > 0:
        # Item already exists in the cart, handle accordingly (e.g., display an error message)
        # ...


        pass
    else:
        query = "INSERT INTO auser (name,  email, password) VALUES (%s, %s, %s)"
        values = (name, email, password)
        cursor.execute(query, values)
        db.commit()
    cursor.close()
    return render_template('form.html')


@app.route('/uins',methods=['POST','GET'])
def uins():
    name = request.form['name']
    email = request.form['email']
    password = request.form['password']
    cursor = db.cursor()
    cursor.execute("select * from usr where name=%s and email=%s and password=%s",(name,email,password))
    cart_data = cursor.fetchall()
    
    
    if len(cart_data) > 0:
        # Item already exists in the cart, handle accordingly (e.g., display an error message)
        # ...
        pass
    else:
        query = "INSERT INTO usr (name,  email, password) VALUES (%s, %s, %s)"
        values = (name, email, password)
        cursor.execute(query, values)
        db.commit()
    cursor.close()
    return render_template('uform.html')


@app.route('/loga',methods=['POST','GET'])
def loga():
    return redirect('/form')

@app.route('/logu',methods=['POST','GET'])
def logu():
    return redirect('/uform')

@app.route('/form',methods=['POST','GET'])
def form():
    # return render_template('form.html')
    if request.method == 'POST':
        # Handle form submission
        cursor = db.cursor()
        email = request.form['email']
        password = request.form['password']
        query = "SELECT * FROM auser WHERE email = %s AND password = %s"
        values = (email, password)
        cursor.execute(query, values)
        user = cursor.fetchall()
        cursor.close()
        if user:
            return render_template('manage.html')
        else:
            return "Login failed"
    else:
        # Render the form template
        return render_template('form.html')

@app.route('/uform',methods=['POST','GET'])
def uform():
     return render_template('uform.html')
@app.route('/man',methods=['POST','GET'])
def man():
    # return render_template('form.html')
    if request.method == 'POST':
        # Handle form submission
        cursor = db.cursor()
        email = request.form['email']
        password = request.form['password']
        query = "SELECT * FROM usr WHERE email = %s AND password = %s"
        values = (email, password)
        
        cursor.execute(query, values)
        user = cursor.fetchall()
        cursor.close()
        if user:
            session['user']=email
            return render_template('dashboard.html')
        else:
            return "Login failed"
    else:
        # Render the form template
        return render_template('uform.html')

@app.route('/show',methods=['POST','GET'])
def show():
    if request.method == 'POST':
        return render_template('add.html')


@app.route('/uregister',methods=['POST','GET'])
def uregister():
    return render_template('uregister.html')

@app.route('/ii',methods=['POST','GET'])
def ii():
    if request.method == 'POST':
        photo = request.files['photo']
        description = request.form['description']
        category = request.form['category']
        quantity = request.form['quan']
        name=request.form['name']
        price =request.form['price']
        mycursor = db.cursor()
        sql = "INSERT INTO items (path,name,price,category,  quantity,description) VALUES (%s,%s, %s,%s, %s, %s)"
        val = (photo.filename,name,price, category,  quantity,description)
        mycursor.execute(sql, val)
        sql=  f"INSERT INTO {category} (path,name,price, quantity,description) VALUES (%s,%s, %s, %s, %s)"
        val=(photo.filename,name,price,  quantity,description)
        mycursor.execute(sql, val)

        db.commit()
        return "Item added successfully"
    return render_template('add.html')

@app.route('/view', methods=['POST', 'GET'])
def show_items():
    cursor = db.cursor()
    cursor.execute("SELECT * FROM items")
    data = cursor.fetchall()
    html = "<html><head><link rel='stylesheet' href='{}'></head><body>".format(url_for('static', filename='css/style.css'))
    html += "<div class='container'>"
   
    for item in data:
        html += "<div class='item'>"
        html += "<img src='/static/images/{}'>".format(item[0])
        html += "<h3>{}</h3>".format(item[1])
        html += "<p>Price:{}</p>".format(item[2])
        html += "<p>Category:{}</p>".format(item[3])
        html += "<p>Available:{}</p>".format(item[4])
        html += "</div>"
    html += "</div></body></html>"
    cursor.close()
    return html

@app.route('/fashion',methods=['POST','GET'])
def fashion():
    cursor = db.cursor()
    cursor.execute("SELECT * FROM items where category='fashion'")
    data = cursor.fetchall()
    html = "<html><head><link rel='stylesheet' href='{}'></head><body>".format(url_for('static', filename='css/style.css'))
    html += "<div class='container'>"
    html += "<form class='total-price' class='dg' action='carts' style='position: absolute; top: 10px; right: 10px;'>"
    html += "<button class='calculate-btn' type='submit'>View cart</button>"
    html += "</form>"

    for item in data:
        html += "<div class='item'>"
        html += "<img src='/static/images/{}'>".format(item[0])
        html += "<h3>{}</h3>".format(item[1])
        html += "<p>Price:{}</p>".format(item[2])
        html += "<p>Category:{}</p>".format(item[3])
        html += "<p>Available:{}</p>".format(item[4])
        html += "<form action='/add_to_cart' method='POST'>"
        html += "<input type='hidden' name='item_id' value='{}'>".format(item[0])
        
        html += "<button type='submit'>Add to Cart</button>"
        html += "</form>"
        html += "</div>"
    html += "</div></body></html>"
    cursor.close()
    return html

@app.route('/beauty',methods=['POST','GET'])
def beauty():
    cursor = db.cursor()
    cursor.execute("SELECT * FROM items where category='beauty'")
    data = cursor.fetchall()
    html = "<html><head><link rel='stylesheet' href='{}'></head><body>".format(url_for('static', filename='css/style.css'))
    html += "<div class='container'>"
    html += "<form class='total-price' class='dg' action='carts' style='position: absolute; top: 10px; right: 10px;'>"
    html += "<button class='calculate-btn' type='submit'>View cart</button>"
    html += "</form>"

    for item in data:
        html += "<div class='item'>"
        html += "<img src='/static/images/{}'>".format(item[0])
        html += "<h3>{}</h3>".format(item[1])
        html += "<p>Price:{}</p>".format(item[2])
        html += "<p>Category:{}</p>".format(item[3])
        html += "<p>Available:{}</p>".format(item[4])
        html += "<form action='/add_to_cart' method='POST'>"
        html += "<input type='hidden' name='item_id' value='{}'>".format(item[0])
        html += "<input type='hidden' name='name' value='{}'>".format(item[1])
        html += "<input type='hidden' name='category' value='{}'>".format(item[3])
        html += "<button type='submit'>Add to Cart</button>"
        html += "</form>"
        html += "</div>"
    html += "</div></body></html>"
    cursor.close()
    return html

@app.route('/gadgets',methods=['POST','GET'])
def gadgets():
    cursor = db.cursor()
    cursor.execute("SELECT * FROM items where category='gadgets'")
    data = cursor.fetchall()
    html = "<html><head><link rel='stylesheet' href='{}'></head><body>".format(url_for('static', filename='css/style.css'))
    html += "<div class='container'>"
    html += "<form class='total-price' class='dg' action='carts' style='position: absolute; top: 10px; right: 10px;'>"
    html += "<button class='calculate-btn' type='submit'>View cart</button>"
    html += "</form>"

    for item in data:
        html += "<div class='item'>"
        html += "<img src='/static/images/{}'>".format(item[0])
        html += "<h3>{}</h3>".format(item[1])
        html += "<p>Price:{}</p>".format(item[2])
        html += "<p>Category:{}</p>".format(item[3])
        html += "<p>Available:{}</p>".format(item[4])
        html += "<form action='/add_to_cart' method='POST'>"
        html += "<input type='hidden' name='item_id' value='{}'>".format(item[0])
        html += "<input type='hidden' name='name' value='{}'>".format(item[1])
        html += "<input type='hidden' name='category' value='{}'>".format(item[3])
        html += "<button type='submit'>Add to Cart</button>"
        html += "</form>"
        html += "</div>"
    html += "</div></body></html>"
    cursor.close()
    return html

@app.route('/furniture',methods=['POST','GET'])
def furniture():
    cursor = db.cursor()
    cursor.execute("SELECT * FROM items where category='furniture'")
    data = cursor.fetchall()
    html = "<html><head><link rel='stylesheet' href='{}'></head><body>".format(url_for('static', filename='css/style.css'))
    html += "<div class='container'>"
    html += "<form class='total-price' class='dg' action='carts' style='position: absolute; top: 10px; right: 10px;'>"
    html += "<button class='calculate-btn' type='submit'>View cart</button>"
    html += "</form>"

    for item in data:
        html += "<div class='item'>"
        html += "<img src='/static/images/{}'>".format(item[0])
        html += "<h3>{}</h3>".format(item[1])
        html += "<p>Price:{}</p>".format(item[2])
        html += "<p>Category:{}</p>".format(item[3])
        html += "<p>Available:{}</p>".format(item[4])
        html += "<form action='/add_to_cart' method='POST'>"
        html += "<input type='hidden' name='item_id' value='{}'>".format(item[0])
        html += "<input type='hidden' name='name' value='{}'>".format(item[1])
        html += "<input type='hidden' name='category' value='{}'>".format(item[3])
        html += "<button type='submit'>Add to Cart</button>"
        html += "</form>"
        html += "</div>"
    html += "</div></body></html>"
    cursor.close()
    return html


@app.route('/add_to_cart',methods=['POST','GET'])
def add_to_cart():
    item_id = request.form['item_id']
    name=request.form['name']
    category=request.form['category']
    cursor = db.cursor()
    cursor.execute("SELECT * FROM items where path='{}' and name='{}' and category='{}'".format(item_id,name,category))
    # print(session['user'])
    data = cursor.fetchall()
    # print(data)
    cursor.execute("SELECT * FROM carts WHERE user=%s AND path=%s and name=%s ", (session['user'], data[0][0],data[0][1]))
    cart_data = cursor.fetchall()
    
    
    if len(cart_data) > 0:
        # Item already exists in the cart, handle accordingly (e.g., display an error message)
        # ...
        pass
    else:
        cursor.execute("INSERT INTO carts (user, path, name, price, category,quantity, description) VALUES (%s, %s,%s, %s, %s, %s, %s)",
                   (session['user'], data[0][0], data[0][1], data[0][2], data[0][3], data[0][4],data[0][5]))
        db.commit()
    cursor.close()
    return redirect('/{}'.format(category))

@app.route('/carts', methods=['POST', 'GET'])
def carts():
    user_email = session['user']
    cursor = db.cursor()
    cursor.execute("SELECT * FROM carts WHERE user='{}'".format(user_email))
    data = cursor.fetchall()
    html = "<html><head><link rel='stylesheet' href='{}'></head><body>".format(url_for('static', filename='css/style.css'))
    html += "<div class='container'>"

    total_price = 0  # Variable to store the total price of all items in the cart

    for item in data:
        html += "<div class='item'>"
        html += "<img src='/static/images/{}'>".format(item[1])
        html += "<h3>{}</h3>".format(item[2])
        html += "<p>Price: {}</p>".format(item[3])
        html += "<p>Category: {}</p>".format(item[4])
        html += "<p>Available: {}</p>".format(item[5])
        html += "</div>"
        
        total_price += item[3]  # Add the price of the item to the total price

    html += "<button  type='button' onclick='calculateTotal()'>Calculate Total</button>"
    html += "<p id='totalPrice'></p>"  # Placeholder to display the total price
    html += "</div>"
    html += "<script>"
    html += "function calculateTotal() {"
    html += "var totalPrice = {};"  # JavaScript variable to store the total price
    html += "document.getElementById('totalPrice').innerText = 'Total Price: ' + '{}';".format(total_price)
    html += "}"
    html += "</script>"
    html += "</body></html>"

    cursor.close()
    return html

    



if __name__=="__main__":
    app.run(host='0.0.0.0',debug=True)
