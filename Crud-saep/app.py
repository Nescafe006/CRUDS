from flask import Flask, request, url_for, redirect, render_template
import sqlite3

app = Flask(__name__)

def init_db():
    conn = sqlite3.connect('database.db')
    c = conn.cursor()
    
    c.execute(''' 
              CREATE TABLE IF NOT EXISTS usuarios (
              id INTEGER PRIMARY KEY AUTOINCREMENT, 
              nome TEXT NOT NULL, 
              email TEXT NOT NULL       
              )
              
              ''')
    c.execute('''
              CREATE TABLE IF NOT EXISTS tarefas (id INTEGER PRIMARY KEY AUTOINCREMENT,
              id_usuario INTEGER NOT NULL,
              descricao TEXT NOT NULL,
              setor TEXT NOT NULL,
              prioridade TEXT NOT NULL,
              data TEXT NOT NULL,
              status TEXT DEFAULT 'a fazer',
              FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
              
              )         
      ''')
    
    conn.commit()
    conn.close()
    
@app.route('/')
def index():

    conn = sqlite3.connect('database.db')
    c = conn.cursor()
    c.execute("SELECT * FROM tarefas")
    tarefas = c.fetchall()
    conn.close()
    return render_template('index.html', tarefas=tarefas)



@app.route('/add_usuario', methods=['GET', 'POST'])
def add_usuario():
    if request.method == 'POST':
        nome = request.form['nome']
        email = request.form['email']
        conn = sqlite3.connect('database.db')
        c = conn.cursor()
        c.execute("INSERT INTO usuarios (nome, email) VALUES (?, ?)" , (nome, email))
        conn.commit()
        conn.close()
        return redirect(url_for('index'))
    return render_template('add_usuario.html')
        
        
        
@app.route('/add_tarefa', methods=['GET', 'POST'])
def add_tarefa():
    if request.method == 'POST':
        id_usuario = request.form['id_usuario']
        descricao = request.form['descricao']
        setor = request.form['setor']
        prioridade = request.form['prioridade']
        data = request.form['data']
        conn = sqlite3.connect('database.db')
        c = conn.cursor()
        c.execute("""INSERT INTO tarefas (id_usuario, descricao, setor, prioridade, data) VALUES(?, ?, ?, ?, ?)""", (id_usuario, descricao, setor, prioridade, data))
        conn.commit()
        conn.close()
        return redirect(url_for('index'))

    conn = sqlite3.connect('database.db')
    c = conn.cursor()
    c.execute("SELECT id, nome FROM usuarios")
    usuarios = c.fetchall()
    conn.close()
    return render_template('add_tarefa.html',
    usuarios=usuarios)



@app.route('/mudar_status/<int:tarefa_id>', methods=['POST'])
def mudar_status(tarefa_id):
    novo_status = request.form['status']
    if novo_status in ['a fazer', 'fazendo', 'pronto']:
        conn = sqlite3.connect('database.db')
        c = conn.cursor()
        c.execute("UPDATE tarefas SET status = ? WHERE id = ?", (novo_status, tarefa_id))
        conn.commit()
        conn.close()
        return redirect(url_for('index'))
    
    
@app.route('/editar_tarefa/<int:tarefa_id>', methods=['GET', 'POST'])
def editar_tarefa(tarefa_id):
    conn = sqlite3.connect('database.db')
    c = conn.cursor()
    
    if request.method == 'POST':
        descricao = request.form['descricao']
        setor = request.form['setor']
        prioridade = request.form['prioridade']
        data = request.form['data']
        
        c.execute("UPDATE tarefas SET descricao = ?, setor = ?, prioridade = ?, data = ? WHERE id = ?", (descricao, setor, prioridade, data, tarefa_id))
        conn.commit()
        conn.close()
        return redirect(url_for('index'))
    
    else:
        c.execute("SELECT * FROM tarefas WHERE id = ?", (tarefa_id,))
        tarefa = c.fetchone()
        conn.close()
        return render_template('editar_tarefa.html', tarefa=tarefa)
        
    
    
@app.route('/excluir_tarefa/<int:tarefa_id>', methods=['GET'])
def excluir_tarefa(tarefa_id):
    conn = sqlite3.connect('database.db')
    c = conn.cursor()
    c.execute("DELETE FROM tarefas WHERE id = ?", (tarefa_id,))
    conn.commit()
    conn.close()
    return redirect(url_for('index'))
    
        
    
    
    
    
if __name__ == '__main__':
    init_db()
    app.run(debug=True)
    
    
    
    


