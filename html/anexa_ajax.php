<?
  ##---------------------------------------------------
  ##  Envio de Emails pelo SMTP Autenticado usando PEAR
  ##---------------------------------------------------
  # Mais detalhes sobre o PEAR: 
  #   http://pear.php.net/
  #
  # Mais detalhes sobre o PEAR Mail:
  #   http://pear.php.net/manual/en/package.mail.mail-mime.php
  ##---------------------------------------------------
  
  # Faz o include do PEAR Mail e do Mime.
  include ("Mail.php");
  include ("Mail/mime.php");
  
  # Vari�vel de teste de upload
  $up=0;

  # E-mail de destino. Caso seja mais de um destino, crie um array de e-mails.
  # *OBRIGATÓRIO*
  $recipients = 'contato@viaformula.com';

  # Cabe�alho do e-mail.
  $headers = 
    array (
      'From'    => 'contato@viaformula.com', # O 'From' é obrigatorio*.
      'To'      => $recipients,
      'Subject' => 'Mensagem enviada do site'
    );

  # Utilize esta opção caso deseje definir o e-mail de resposta
  # $headers['Reply-To'] = 'EMailDeResposta@DominioDeResposta.com';

  # Utilize esta op��o caso deseje definir o e-mail de retorno em caso de erro de envio
  # $headers['Errors-To'] = 'EMailDeRerornoDeERRO@DominioDeretornoDeErro.com';

  # Utilize esta op��o caso deseje definir a prioridade do e-mail
  # $headers['X-Priority'] = '3'; # 1 UrgentMessage, 3 Normal  

  # Define o tipo de final de linha.
  $crlf = "\r\n";


  #####################################
  #####################################
  #####################################
  # Corpo da Mensagem e texto e em HTML
  #####################################
  #####################################
  #####################################

  $campo_nome     = "<b>Nome:</b><br />".$_POST['_nomeForm']."<br /><br />";
  $campo_telefone = "<b>Telefone:</b><br />".$_POST['_telefoneForm']."<br /><br />";
  $campo_contato  = "<b>E-mail de contato:</b><br />".$_POST['_contatoForm']."<br /><br />";

  $html = "<HTML><BODY>";
  $html .= $campo_nome;
  $html .= $campo_telefone;
  $html .= $campo_contato;
  $html .= "<hr /></BODY></HTML>";


  # Instancia a classe Mail_mime
  $mime = new Mail_mime($crlf);

  # Coloca o HTML no email
  $mime->setHTMLBody($html);

  # Efetua o upload do arquivo
for( $i = 0; $i < count($_FILES['_anexoform']['name']); $i++ ){

  if (is_uploaded_file($_FILES['_anexoform']['tmp_name'][$i])) {
	  $caminho[$i] = "/home/viaformula/www/tmp/".$_FILES['_anexoform']['name'][$i];
	  
	  # grava o $arquivo no $caminho especificado
	  if(copy($_FILES['_anexoform']['tmp_name'][$i],$caminho[$i])) {
	  	$mime->addAttachment($caminho[$i]);
	  	unlink($caminho[$i]);
	  	echo "O arquivo foi transferido!<br>";
	}
	  }else{
		  echo "<h1>O arquivo não foi transferido!</h1>";
		  echo "<h2><font color='red'>Caminho ou nome de arquivo Inválido</font></h2>";
		  }
}

##  # Anexa um arquivo ao email.
  
  # Procesa todas as informações.
  $body = $mime->get();
  $headers = $mime->headers($headers);

  # Parâmetros para o SMTP. *OBRIGATORIO*
  $params = 
    array (
      'auth' => true, # Define que o SMTP requer autenticação.
      'host' => 'smtp.viaformula.com', # Servidor SMTP
      'username' => 'contato=viaformula.com', # USUARIO do SMTP
      'password' => '123@Mudar' # Senha do seu MailBox.
    );
    
  # Define o MÉTODO de envio
  $mail = new Mail();
  $mail_object = $mail->factory('smtp', $params);

  # Envia o email. Se n�o ocorrer erro, retorna TRUE caso contr�rio, retorna um
  # objeto PEAR_Error. Para ler a mensagem de erro, use o m�todo 'getMessage()'.
  
  #THIAGO EDIT: COMENTEI O CODIGO

  #codigo responsavel pelo envio do e-mail
  $result = $mail_object->send($recipients, $headers, $body);
  /*if (PEAR::IsError($result))
  {
    echo "ERRO ao tentar enviar o email. (" . $result->getMessage(). ")";
  }   
  else
  {
    echo "Email enviado com sucesso!";
       
  }   */
  #/THIAGO EDIT: COMENTEI O CODIGO


?>			
