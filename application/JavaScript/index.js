	
  
  
const randomColor = (format) => {		    
  var rint = Math.floor( 0x100000000 * Math.random());
  switch( format ){
    case 'hex':
      return '#' + ('00000'   + rint.toString(16)).slice(-6).toUpperCase();
    case 'hexa':
      return '#' + ('0000000' + rint.toString(16)).slice(-8).toUpperCase();
    case 'rgb':
      return 'rgb('  + (rint & 255) + ',' + (rint >> 8 & 255) + ',' + (rint >> 16 & 255) + ')';
    case 'rgba':
      return 'rgba(' + (rint & 255) + ',' + (rint >> 8 & 255) + ',' + (rint >> 16 & 255) + ',' + (rint >> 24 & 255)/255 + ')';
    default:
      return rint;
  }
}
