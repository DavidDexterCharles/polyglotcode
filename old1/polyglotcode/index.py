import flask, flask.views
import os
app = flask.Flask(__name__)
app.secret_key = "apples" # DONT DO THIS
#os.listdir('.') list all in the current directory
#open('index.py').read()
#open('templates/test.html','w').write("Very Interesting")
class View (flask.views.MethodView):
    def get(self):
        return flask.render_template('index.html')
    def post(self):
        result =  eval(flask.request.form['expression'])
        flask.flash(result)
        return str(self.get())
        #return str(flask.request.form['expression'])#expression refers to the name of the field in the html
        #return flask.render_template('test.html')
app.add_url_rule('/', view_func=View.as_view('main'),methods=['GET','POST'])
app.debug = True
app.run()