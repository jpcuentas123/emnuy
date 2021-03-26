import logo from './logo.svg';
import './App.css';

const App = () => {
  return (
    <form className="EntrepreneurshipForm" action="" method="POST" enctype="multipart/form-data">
      <header>
        <h4>Publicar emprendimiento</h4>
      </header>
      <section className="EntrepreneurshipForm-section">

        <div>
          <label for="">Nombre del emprendimiento</label>
          <input value="" placeholder="" required id="entrepreneurship_name" name="entrepreneurship_name"
            autocomplete="given-name" />
        </div>

        <div>
          <label for="">Correo electrónico</label>
          <input value="" placeholder="" required id="entrepreneurship_email" name="entrepreneurship_email"
            autocomplete="email" />
        </div>

      </section>

      <section className="EntrepreneurshipForm-section">

        <div>
          <label for="">Teléfono de contacto</label>
          <input value="" placeholder="" required id="entrepreneurship_tel" name="entrepreneurship_tel" autocomplete="tel" />
        </div>

        <div>
          <label for="">País</label>
          <input value="" placeholder="" required id="entrepreneurship_country" name="entrepreneurship_country"
            autocomplete="country" />
        </div>

      </section>

      <section className="EntrepreneurshipForm-section">

        <div>
          <label for="">¿Quieres adjuntar tu logo?</label>
          <input value="" type="file" placeholder="" id="entrepreneurship_logo" name="entrepreneurship_logo" />
        </div>
        <div>
          <label for="">Cuentanos más sobre tu emprendimiento</label>
          <textarea value="" placeholder="" id="entrepreneurship_info" name="entrepreneurship_info">
          </textarea>
        </div>

      </section>

      <section className="EntrepreneurshipForm-section lastsection">

        <div>
          <label for="">¿Tienes página web para que toda nuestra comunidad te pueda visitar?</label>
          <input value="" type="url" placeholder="" id="entrepreneurship_website" name="entrepreneurship_website"
            autocomplete="url" />
        </div>
        <div className="">
          <label for="">¿Autorizas que compartamos tu información en esta red para que los miembros de la comunidad
          conozcan sobre tu emprendimiento?
                <input type="checkbox" placeholder="Si" required id="entrepreneurship" name="entrepreneurship" />
          </label>
        </div>

      </section>
      <section>
        
      </section>
    </form>


  );
}

export default App;
