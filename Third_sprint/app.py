import sqlite3
import qrcode
import json
from flask import Flask, render_template, request, url_for, redirect, session
from datetime import datetime
from flask_selfdoc import Autodoc
from PIL import Image
import base64
import io
#from flask_selfdoc import Autodoc


app = Flask(__name__)  
app.secret_key = "Lanjio"
rand_list = []

auto = Autodoc(app)

def db_connection(): #database connection
    """SQLite3 python connection

    Returns:
       sqlite3.connect: connection pointer
    """
    conn = None
    try: 
        conn = sqlite3.connect("project.sqlite") 
    except sqlite3.error as e: 
        print(e) 
    return conn  


@app.route('/')
@auto.doc()
def index():
    """Index page backend

    Content:
        Here users navigate around different pages.
    """
    if not session.get('loggedIn'):
        return render_template("landingpage.html") 
    return redirect(url_for('homepage'))

@app.route('/home')
@auto.doc()
def homepage():
    """Home page backend

    Content:
        This page is for content redirection for different user base.
    """
    if not session.get('loggedIn'):
        return redirect(url_for('index'))
    if session.get('loggedIn') == 'hospital':
        return redirect(url_for('LoginHospital'))
    if session.get('loggedIn') == 'visitor':
        return redirect(url_for('vistname'))
    if session.get('loggedIn') == 'place':
        return redirect(url_for('Agent'))
    if session.get('loggedIn') == 'agent':
        return redirect(url_for('LoginAgent'))
    return 'you are not supposed to be here'

@app.route('/Agent', methods=['GET','POST'])
@auto.doc()
def LoginAgent(): #login function for Agent 
        """Agent Login page backend

        Form Data: 
            username: Username
            password: Password
        If right credentials, redirects to portal.
        If invalid credentials, display an error message and retry.
        """
        if session.get('loggedIn'):
            if session.get('loggedIn') == 'agent':
                search_id = request.args.get('search', '-1') 
                if not search_id.isnumeric():
                    search_id = -1
                return render_template('agent_portal.html', data=getAllUsers(search_id))
            else:
                return redirect(url_for('index'))
        else:
            conn = db_connection() 
            cursor = conn.cursor() 
            if request.method == "POST":
                agnt_username = request.form["username"] 
                agnt_password = request.form["password"]  
                statement = f"SELECT * from Agent WHERE username='{agnt_username}' AND password='{agnt_password}';"
                cursor.execute(statement)
                user = cursor.fetchone() 
                if user:
                    session['loggedIn'] = 'agent'
                    session['email'] = agnt_username
                    return render_template('agent_portal.html', data=getAllUsers())
                else: 
                    return render_template("Loginagency.html", invalid_credentials=True)  
            return render_template("Loginagency.html")
      
@app.route('/Hospital', methods=['GET','POST']) 
@auto.doc()
def LoginHospital(): #Login function for Hospital
        """Hospital Login page backend

        Form Data: 
            username: Username
            password: Password
        If right credentials, redirects to portal.
        If invalid credentials, display an error message and retry.
        """
        conn = db_connection() 
        cursor = conn.cursor()
        if session.get('loggedIn'):
            if session.get('loggedIn') == 'hospital':
                vist_search = request.args.get('search', '').lower()
                sql = f"SELECT citizen_id, visitor_name,email, phone_number, address, infected from Visitor WHERE lower(visitor_name)='{vist_search}' OR citizen_id='{vist_search}';"  
                cursor.execute(sql)  
                data = cursor.fetchall()  
                return render_template("hospital_portal.html", data=data) 
            else:
                return redirect(url_for('index'))
        else:
            if request.method == "POST": 
                Hsptl_id = request.form["id"]
                Hsptl_username = request.form["username"] 
                Hsptl_password = request.form["password"]  
                statement = f"SELECT * from Hospital WHERE hospital_id='{Hsptl_id}' AND username='{Hsptl_username}' AND password='{Hsptl_password}';"
                cursor.execute(statement)
                user = cursor.fetchone()
                if user: 
                    session['loggedIn'] = 'hospital'
                    session['username'] = Hsptl_username
                    return render_template("hospital_portal.html") 
                else: 
                    return render_template("hospitalLogin.html", invalid_credentials=True) 
            else: 
                return render_template("hospitalLogin.html")

@app.route('/Visitor', methods=['POST', 'GET']) 
@auto.doc()
def vistname():
    """Visitor Login page backend

        Form Data: 
            email: Email
            password: Password
        If right credentials, redirects to portal.
        If invalid credentials, display an error message and retry.
    """   
    if session.get('loggedIn'):
            if session.get('loggedIn') == 'visitor':
                if isCheckedIn(session.get('userID')):
                    return render_template('visitor_portal.html', citizen_id=session.get('userID'), checkedIn=True, username=getVisitorInfo(session.get('userID'))[1], covidStatus='Positive' if getVisitorCovidStatus(session.get('userID')) else 'Negative')
                else:
                    return render_template('visitor_portal.html', citizen_id=session.get('userID'), username=getVisitorInfo(session.get('userID'))[1], covidStatus='Positive' if getVisitorCovidStatus(session.get('userID')) else 'Negative')
            else:
                return redirect(url_for('index'))
    else:
        conn = db_connection() 
        cursor = conn.cursor() 
        if request.method == "POST":
            vist_email = request.form["email"] 
            vist_password = request.form["password"]  
            statement = f"SELECT * from Visitor WHERE email='{vist_email}' AND password='{vist_password}';"
            cursor.execute(statement)    
            user = cursor.fetchone()
            if user: 
                session['loggedIn'] = 'visitor'
                session['vist_email'] = vist_email
                session['userID'] = user[0]
                return redirect(url_for('vistname'))
            else: 
                return render_template("loginVisitor.html", invalid_credentials=True) 
        else: 
            return render_template("loginVisitor.html")

@app.route('/Place', methods=['POST', 'GET'])
@auto.doc()
def Place():
    """Place Login page backend

        Form Data: 
            email: Email
            password: Password
        If right credentials, redirects to portal.
        If invalid credentials, display an error message and retry.
    """  
    if session.get('loggedIn'):
            if session.get('loggedIn') == 'place':
                return render_template('place_portal.html', data=getCheckedInAtPlace(session.get('userID')))
            else:
                return redirect(url_for('index'))
    else:
        conn = db_connection() 
        cursor = conn.cursor() 
        if request.method == "POST":
            place_email = request.form["email"] 
            place_password = request.form["password"]  
            statement = f"SELECT * from Place WHERE email='{place_email}' AND password='{place_password}';"
            cursor.execute(statement)    
            user = cursor.fetchone()
            if user: 
                session['loggedIn'] = 'place'
                session['email'] = place_email
                session['userID'] = user[0]
                return redirect(url_for('Place'))
            else: 
                return render_template("loginPlace.html", invalid_credentials=True) 
        else: 
            return render_template("loginPlace.html")


@app.route('/logout')
@auto.doc()
def logout():
    session['loggedIn'] = None
    session['email'] = None
    session['userID'] = None
    return redirect(url_for('index'))

@app.route('/register',methods=['POST','GET']) 
@auto.doc()
def register():  #Register for visitors
    """Visitor resgistration backend

    Form:
        Here visitor can set their new email, password, and their demographics.
    """
    if not session.get('loggedIn'):
        conn = db_connection()   
        cursor = conn.cursor()  
        if request.method == "POST":   
            vist_name = request.form["Vorname"]  
            vist_email = request.form["email"] 
            vist_phone = request.form["phone"] 
            vist_add = request.form["address"] 
            vist_pass = request.form["password"] 
            sql = """INSERT INTO Visitor (visitor_name,email,phone_number,address,password,infected) VALUES(?,?,?,?,?,?)""" 
            cursor = cursor.execute(sql,(vist_name,vist_email,vist_phone,vist_add,vist_pass, 0)) 
            conn.commit() 
            return render_template('success_visitor_reg.html')   
        return render_template("Registerpagev.html")  
    else:
        return redirect(url_for('index'))

@app.route('/pregister', methods=['POST','GET'])
@auto.doc()
def pregister():   #place registration
    """Place resgistration backend

    Form:
        Here place owners can set their establishment infos, email and password.
    """
    if not session.get('loggedIn'):
        conn = db_connection()   
        cursor = conn.cursor() 
        if request.method == "POST":  
            try:
                place_name = request.form["place_name"]  
                place_phone = request.form["number"] 
                place_add = request.form["address"]
                place_email = request.form["email"] 
                place_password = request.form["password"]  
                sql = """INSERT INTO Place(place_name,email,password,phone_number,address) VALUES(?,?,?,?,?)""" 
                cursor = cursor.execute(sql,(place_name, place_email, place_password, place_phone, place_add)) 
                conn.commit()  
                return render_template('success_place_reg.html')
            except Exception as e:
                print(e) 
                return  "Error"
        return render_template("PlaceRegistration.html") 
    else:
        return redirect(url_for('index'))

@app.route('/QRcode')
@auto.doc()
def displayQR():
    """Display QR code page

        Here place owners can download the QR code for their places.
    """
    if session.get('loggedIn') == 'place':
        vist_qr = '/visit/'+str(session.get('userID'))
        img = qrcode.make(vist_qr) #qr code generated 
        data = io.BytesIO()
        img.save(data, "JPEG")
        encoded_image_data = base64.b64encode(data.getvalue())
        return render_template('qr_code.html', image=encoded_image_data.decode('utf-8'))
    else:
        return redirect(url_for('index'))

def GenerateQR(placeID):
    vist_qr = '/visit/'+str(placeID)
    img = qrcode.make(vist_qr) #qr code generated 
    data = io.BytesIO()
    img.save(data, "JPEG")
    encoded_image_data = base64.b64encode(data.getvalue())

def getVisitorCovidStatus(id):
    conn = db_connection()   
    cursor = conn.cursor() 
    statement = f'SELECT infected FROM Visitor WHERE citizen_id={id};'
    cursor.execute(statement)
    user = cursor.fetchone()
    return user[0]

@app.route('/visit/<int:placeID>', methods=['POST', 'GET'])
@auto.doc()
def visitPlace(placeID):
    """Visit Place mechanism

        Inserts the check in time to the database
    """
    if session.get('loggedIn') == 'visitor':
        if isCheckedIn(session.get('userID')):
            return 'Already checked in'
        else:
            conn = db_connection() 
            cursor = conn.cursor()
            statement = f"""INSERT INTO Visiting (citizen_id, place_id, check_in_time) VALUES ({session.get('userID')}, {placeID}, '{datetime.now()}'); UPDATE Visitor SET checked_in=1 WHERE citizen_id={session.get('userID')};"""
            cursor.executescript(statement)
            conn.commit()
            return 'done'
    else:
        """ return render_template('ErrorVisiting.html') """
        return 'error' 

def isCheckedIn(id):
    conn = db_connection() 
    cursor = conn.cursor()
    statement = f'SELECT checked_in FROM Visitor WHERE citizen_id={id}'
    cursor.execute(statement)
    checked = cursor.fetchone()
    return bool(checked[0])

@app.route('/checkout', methods=['POST', 'GET'])
@auto.doc()
def checkout():
    """Check out function

        Checks out the visitor from the establishment
    """
    if session.get('loggedIn') == 'visitor':
        conn = db_connection() 
        cursor = conn.cursor()
        statement = f"SELECT visiting_id FROM Visiting WHERE citizen_id={session.get('userID')} AND check_out_time IS NULL;"
        cursor.execute(statement)
        rows = cursor.fetchone()
        if rows:
            statement = f"""UPDATE Visiting SET check_out_time="{datetime.now()}" WHERE citizen_id={session.get("userID")};; UPDATE Visitor SET checked_in=0 WHERE citizen_id={session.get("userID")};"""
            cursor.executescript(statement)
            conn.commit()
            return redirect(url_for('vistname'))
        else:
            return redirect(url_for('vistname', error='Not Checked In'))
    else:
        """ return render_template('ErrorVisiting.html') """
        return redirect(url_for('index', error='Not Logged In As a Visitor'))

@app.route('/imprint')
@auto.doc()
def imprint(): #imprint
    """This is the imprint page
    """
    return render_template("imprint.html")    

@app.route('/append',methods=['POST'])
@auto.doc()
def append(): #function to edit the infected
    """Visitor data append by hospital

        Task:
        Can append the user corona status
    """
    conn = db_connection()   
    cursor = conn.cursor() 
    if request.method == "POST":  
        vist_id = request.form["id"] 
        vist_inf = request.form["Infected"]  #infected 0 being false and 1 being true
        stat = f"SELECT * from Visitor WHERE citizen_id='{vist_id}';" #updating the infected the value infected
        cursor.execute(stat) 
        value = cursor.fetchone()
        if (int(vist_inf) == 1 or int(vist_inf) == 0) and value != None:  #checking for valif id and infected value
            cursor.execute("UPDATE Visitor SET infected = ?\
                            WHERE citizen_id = ?",
                        (vist_inf, vist_id))
            conn.commit()  
            return redirect(url_for('LoginHospital', search = vist_id), code = 307) 
        else:  
            return "Infected should be between 0 and 1 or wrong id"
    else: 
        return redirect(url_for('LoginHospital')) 

@app.route('/getPlaceInfo/<int:id>', methods=['GET'])
def getPlaceInfo(id):
    conn = db_connection()   
    cursor = conn.cursor() 
    statement = f'SELECT * FROM Place WHERE place_id={id};'
    cursor.execute(statement)
    user = cursor.fetchone()
    return json.dumps(user)

def getVisitorInfo(id):
    conn = db_connection()   
    cursor = conn.cursor() 
    statement = f'SELECT * FROM Visitor WHERE citizen_id={id};'
    cursor.execute(statement)
    user = cursor.fetchone()
    return user

@app.route('/checkedInPlaceInfo', methods=['GET'])
def getCheckedInPlaceInfo():
    if session.get('loggedIn') == 'visitor':
        conn = db_connection()   
        cursor = conn.cursor() 
        statement = f'SELECT Visiting.visiting_id, Visiting.citizen_id, Visiting.place_id, Place.place_name, Visiting.check_in_time, Visiting.check_out_time FROM Visiting INNER JOIN Visitor ON Visiting.citizen_id = Visitor.citizen_id INNER JOIN Place ON Visiting.place_id = Place.place_id WHERE Visiting.citizen_id={session.get("userID")} AND Visiting.check_out_time IS NULL;'
        cursor.execute(statement)
        user = cursor.fetchone()
        return json.dumps(user)
    else:
        return 'You are not logged in as a visitor'

def getCheckedInAtPlaceALL(placeID):
    conn = db_connection()   
    cursor = conn.cursor() 
    statement = f'SELECT Visitor.visitor_name, Visitor.email, Visiting.check_in_time, Visiting.check_out_time, Visitor.infected FROM Visiting INNER JOIN Visitor ON Visiting.citizen_id = Visitor.citizen_id INNER JOIN Place ON Visiting.place_id = Place.place_id WHERE Visiting.place_id={placeID};'
    cursor.execute(statement)
    users = cursor.fetchall()
    return users

def getCheckedInAtPlace(placeID):
    conn = db_connection()   
    cursor = conn.cursor() 
    statement = f'SELECT Visitor.visitor_name, Visitor.email, Visiting.check_in_time, Visitor.infected FROM Visiting INNER JOIN Visitor ON Visiting.citizen_id = Visitor.citizen_id INNER JOIN Place ON Visiting.place_id = Place.place_id WHERE Visiting.place_id={placeID} AND Visiting.check_out_time IS NULL;'
    cursor.execute(statement)
    users = cursor.fetchall()
    return users

def getAllUsers(searchID = -1):
    conn = db_connection()   
    cursor = conn.cursor()
    if searchID == -1: 
        statement = f'SELECT * FROM Visitor;'
    else:
        statement = f'SELECT * FROM Visitor WHERE citizen_id={searchID};'
    cursor.execute(statement)
    users = cursor.fetchall()
    users = [list(user) for user in users]
    for user in users: 
        statement = f'SELECT COUNT(*) FROM Visiting WHERE citizen_id={user[0]};'
        cursor.execute(statement)
        n_visits = cursor.fetchone()[0]
        user.append(n_visits)
    return users

@app.route('/docs')
@auto.doc()
def documentation():
    return auto.html(title='Corona Archive API documentation')


if __name__ == "__main__": 
    app.run(debug=True) 