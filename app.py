from http import server
from flask import Flask, render_template, url_for, request
import jinja2
from flask_mail import Mail, Message

# Flask Part ####################################

app = Flask(__name__)

 
# Flask-mail config part #######################
app.config['MAIL_SERVER']='smtp.mailtrap.io'
app.config['MAIL_PORT'] = 2525
app.config['MAIL_USERNAME'] = '1f6028eaa12d53'
app.config['MAIL_PASSWORD'] = '6c707052e93c1f'
app.config['MAIL_USE_TLS'] = True
app.config['MAIL_USE_SSL'] = False

mail = Mail(app)

# var part ####################################
var_top_nav_bar=['Главная',
                 'информация',
                 'Терминология',
                 'Оптовая торговля',
                 'kontakt']

var_language={1:'Rus',
              2:'Eng',
              3:'Arab'}

company_title= {'ru':'Продимэкс',
                'en':'Prodimaks'}

####################################
@app.route('/') 
def index_func(): 
    global company_title_ru
    page_title='Index'
    return render_template('index.html',
                           page_title=page_title,company_title=company_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)


@app.route('/Полезная информация')
def useful_info_func():
    page_title='Information'
    return render_template('useful_info.html',
                           page_title=page_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)

@app.route('/Терминология')
def term_func():
    page_title='Termenology'
    return render_template('term.html',
                           page_title=page_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)


@app.route('/kontakt', methods=["Get"])
def kontakt_func():
    page_title='contact'
    return render_template('kontakt.html',
                           page_title=page_title,
                           var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)


@app.route('/Оптовая_торговля_фруктами_овощами',)
def obt_fru_obst_func():
    page_title='obt_fru_obst'
    return render_template('obt_fru_obst.html',
                           page_title=page_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)

@app.route('/about')
def about_func():
    page_title='About'
    return render_template('about.html',
                           page_title=page_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)


@app.route('/eng',)
def eng_page_func():
    page_title='eng'
    return render_template('eng.html',
                           page_title=page_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)
#############################################


# send_email_func ##################################
@app.route("/send_email", methods=["Post" ,"Get"])
def send_email_func():
    sender_name= request.form.get("sender_name")
    sender_email=request.form.get("sender_email")
    sender_tel=request.form.get("sender_tel")
    sender_message=request.form.get("sender_message")
    try:
        msg = Message('Hello, This Msg from Prodimaks site!', sender =sender_name , reply_to=sender_email, recipients = ['info@Prodimaks.com'])
        msg.body = sender_message
        mail.send(msg)
        return "Hallo Mr. " + sender_name + "Your Message sent!" 
        
    
    except Exception as e:
        return str(e)
#############################################
if __name__ == '__main__':
   
    app.run(debug=True)
    


# action="{{ url_for( 'send_email_func') }}"
