<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Via Fórmula - Farmácia de Manipulação</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Spectral:600" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
      <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">







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

      $campo_nome     = "<b>Nome:</b><br />".$_POST['nome']."<br /><br />";
      $campo_telefone = "<b>Telefone:</b><br />".$_POST['telefone']."<br /><br />";
      $campo_contato  = "<b>E-mail de contato:</b><br />".$_POST['contato']."<br /><br />";

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
      for( $i = 0; $i < count($_FILES['anexo']['name']); $i++ ){

        if (is_uploaded_file($_FILES['anexo']['tmp_name'][$i])) {
          $caminho[$i] = "/home/viaformula/www/tmp/".$_FILES['anexo']['name'][$i];
          
          # grava o $arquivo no $caminho especificado
          if(copy($_FILES['anexo']['tmp_name'][$i],$caminho[$i])) {
            $mime->addAttachment($caminho[$i]);
            unlink($caminho[$i]);
            //echo "<span class='text-center resposta-form'>O arquivo foi transferido!</span>";

                  ##  # Anexa um arquivo ao email.
                    
                    # Procesa todas as informa��es.
                    $body = $mime->get();
                    $headers = $mime->headers($headers);

                    # Par�metros para o SMTP. *OBRIGAT�RIO*
                    $params = 
                      array (
                        'auth' => true, # Define que o SMTP requer autentica��o.
                        'host' => 'smtp.viaformula.com', # Servidor SMTP
                        'username' => 'contato=viaformula.com', # Usu�rio do SMTP
                        'password' => '123@Mudar' # Senha do seu MailBox.
                      );
                      
                    # Define o m�todo de envio
                    $mail = new Mail();
                    $mail_object = $mail->factory('smtp', $params);

                    # Envia o email. Se n�o ocorrer erro, retorna TRUE caso contr�rio, retorna um
                    # objeto PEAR_Error. Para ler a mensagem de erro, use o m�todo 'getMessage()'.
                    $result = $mail_object->send($recipients, $headers, $body);
                    if (PEAR::IsError($result))
                    {
                      echo "ERRO ao tentar enviar o email. (" . $result->getMessage(). ")";
                    }   
                    else
                    {
                      echo "<p class='text-center resposta-form'>Email enviado com sucesso!<br /><a href='http://www.viaformula.com'>Clique aqui para voltar</a></p>";
                    }   




        }
          }else{
            echo "<h1>O arquivo não foi transferido!</h1>";
            echo "<h2><font color='red'>Caminho ou nome de arquivo Inválido</font></h2>";
            }
      }
    ?>








                        <p class="intro-text">
                            <img src="./img/vf-logo.png" alt="" class="img-responsive">
                        </p>







                    </div>
                </div>
            </div>
        </div>
    </header>
    

    <script src="vendor/jquery/jquery.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!--<script src="js/validate.js?777"></script>-->

    

</body>

</html>
