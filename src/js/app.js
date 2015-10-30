//
// ES6 baby!!
//
import contactMap from './contact.js';
import { isElementInViewport } from './utils.js';
import $ from 'jquery';
import matchHeight from 'jquery-match-height';

class WpAtom{

  constructor(){
    this.setupjQueryNodes();
    this.setupEvents();
  }

  setupjQueryNodes(){
    this.$document = $(document);
    this.$window = $(window);
  }

  setupEvents(){
    this.$document.on('ready', this.init);
    this.$window.on('resize', this.resize);
    this.$window.load(this.load.bind(this));
  }

  init(){
    contactMap.init();
  }
  
  resize(){

  }

  load(){
    this.makeEqualHeight([
        '.box'
      ]);
  }

  makeEqualHeight(selectors){
    selectors.forEach( selector => {
      $(selector).matchHeight();
    })
  }
}


let wpAtom = new WpAtom();