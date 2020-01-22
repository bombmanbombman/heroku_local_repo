
enable=console.log('onerror has been loaded');

function errorhandler(message,url,line){
  out = 'Sorry,an error was encountered.\n\n';
  out +='Error: '+message+'\n';
  out +='URL: ' +url+'\n';
  out +='Line: '+line+'\n';
  out +='Click OK to continue.\n';
  alert(out);
  return true;
}

onerror = errorhandler;