<div class="section">
    <div class="container">
        <div class="row content-items">
            <div class="col-12">
                <div class="section-heading">
                    <div class="section-subheading">Estamos sempre em contato</div>
                    <h1>Contatos</h1>
                </div>
            </div>
            <div class="col-xl-4 col-md-5 content-item">
                <div class="contact-info section-bgc">
                    <h3>Entre em Contato</h3>
                    <ul class="contact-list">
                        <li>
                            <i class="material-icons material-icons-outlined md-22">location_on</i>
                            <div class="footer-contact-info">
                                <a href="">
                                    Alameda Nothman
                                </a>
                            </div>
                        </li>
                        <li>
                            <i class="material-icons material-icons-outlined md-22">smartphone</i>
                            <div class="footer-contact-info">
                                <a href="tel:+13239134688" class="formingHrefTel">+55 (11) 91234-5678</a>
                                <a href="tel:+13238884554" class="formingHrefTel">+55 (11) 91234-5678</a>
                            </div>
                        </li>
                        <li>
                            <i class="material-icons material-icons-outlined md-22">email</i>
                            <div class="footer-contact-info">
                                <a href="mailto:mail@example.com">mail@example.com</a>
                                <a href="mailto:info@example.com">info@example.com</a>
                            </div>
                        </li>
                        <li>
                            <i class="material-icons material-icons-outlined md-22">schedule</i>
                            <div class="footer-contact-info">
                                <p>Seg - Sex: 9:00 - 18:00</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-8 col-md-7 content-item">
                <form action="./enviar.contato.php" method="post" class="form-submission contact-form contact-form-padding" novalidate>
                    <input type="hidden" name="Subject" value="Formulário de Contato">
                    <div class="row gutters-default">
                        <div class="col-12">
                            <h3>Formulário de Contato</h3>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="form-field">
                                <label for="contact-name" class="form-field-label">Nome Completo</label>
                                <input type="text" class="form-field-input" name="nome" value="" autocomplete="off" id="contact-name" required data-pristine-required-message="Este campo é obrigatório.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="form-field">
                                <label for="contact-phone" class="form-field-label">Número de Telefone</label>
                                <input type="tel" class="form-field-input mask-phone" name="telefone" value="" autocomplete="off" id="contact-phone" required data-pristine-required-message="Este campo é obrigatório.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="form-field">
                                <label for="contact-email" class="form-field-label">Endereço de Email</label>
                                <input type="email" class="form-field-input" name="email" value="" autocomplete="off" id="contact-email" required data-pristine-required-message="Este campo é obrigatório." data-pristine-email-message="Por favor, insira um endereço de email válido.">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-field">
                                <label for="contact-message" class="form-field-label">Sua Mensagem</label>
                                <textarea name="mensagem" class="form-field-input" id="contact-message" cols="30" rows="6"></textarea>
                            </div>
                            <div class="form-btn">
                                <button type="submit" class="btn btn-w240 ripple"><span>Enviar Mensagem</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
