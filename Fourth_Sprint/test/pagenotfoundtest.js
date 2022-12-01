const { expect } = require('chai');
const chai = require('chai');
const { JSDOM } = require('jsdom');

chai.use(require('chai-dom'));
require('jsdom-global')();

describe('./error404.php', () => {
  beforeEach((done) => {
   JSDOM.fromFile('./error404.php')
   .then((dom) => {
     global.document = dom.window.document
   })
 .then(done, done);
 })



 describe("404", () => {
 it("                Page Not Found", () => {
  let element = document.querySelector('h3')
  expect(element).to.have.text("                404 Page Not Found Error")
 })
})
})