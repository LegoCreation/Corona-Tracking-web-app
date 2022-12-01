const { expect } = require('chai');
const chai = require('chai');
const { JSDOM } = require('jsdom');

chai.use(require('chai-dom'));
require('jsdom-global')();

describe('../visitor/visitorLogin.php', () => {
  beforeEach((done) => {
   JSDOM.fromFile('../visitor/visitorLogin.php')
   .then((dom) => {
     global.document = dom.window.document
   })
 .then(done, done);
 })



 describe("Website Title", () => {
 it("Login", () => {
  let element = document.querySelector('h2')
  expect(element).to.have.text("Login")
 }) 
})
}) 