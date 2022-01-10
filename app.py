from flask import Flask, render_template, url_for
import jinja2


# var part ####################################
var_top_nav_bar=['Главная',
                 'Полезная информация',
                 'Терминология',
                 'Оптовая торговля фруктами и овощами',
                 'kontakt']

var_language={1:'Rus',
              2:'Eng',
              3:'Arab'}

company_title= {'ru':'Продимпэкс',
                'en':'Prodimaks'}



# Flask Part ####################################
app = Flask(__name__)


#@app.route('/', methods=['POST', 'GET']) 
@app.route('/iindex') 
def index(): 
    global company_title_ru
    page_title='Index'
    return render_template('index.html',
                           page_title=page_title,company_title=company_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)


@app.route('/Полезная информация')
def useful_info():
    page_title='Kontakt'
    return render_template('useful_info.html',
                           page_title=page_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)

@app.route('/Терминология')
def term():
    page_title='Терминология'
    return render_template('term.html',
                           page_title=page_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)


@app.route('/kontakt')
def kontakt():
    page_title='Kontakt'
    return render_template('kontakt.html',
                           page_title=page_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)


@app.route('/Оптовая_торговля_фруктами_овощами',)
def obt_fru_obst():
    page_title='obt_fru_obst'
    return render_template('obt_fru_obst.html',
                           page_title=page_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)

@app.route('/about')
def about():
    page_title='About'
    return render_template('about.html',
                           page_title=page_title,var_top_nav_bar=var_top_nav_bar,
                           var_language=var_language)

################################################
#...
if __name__ == '__main__':
    app.run(debug=True )
    
