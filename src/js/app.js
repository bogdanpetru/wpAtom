//
// ES6 baby!!
//

import contactMap from './contact.js';
import { isElementInViewport } from './utils.js';
import $ from 'jQuery';

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
    this.$window.load(this.load);
  }

  init(){
    contactMap.init();
  }
  
  resize(){
  }

  load(){
  }
}

let wpAtom = new WpAtom();