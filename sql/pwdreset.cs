using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Loginsystem
{
    #region Pwdreset
    public class Pwdreset
    {
        #region Member Variables
        protected int _pwdResetId;
        protected string _pwdResetEmail;
        protected string _pwdResetSelector;
        protected string _pwdResetToken;
        protected string _pwdResetExpires;
        #endregion
        #region Constructors
        public Pwdreset() { }
        public Pwdreset(string pwdResetEmail, string pwdResetSelector, string pwdResetToken, string pwdResetExpires)
        {
            this._pwdResetEmail=pwdResetEmail;
            this._pwdResetSelector=pwdResetSelector;
            this._pwdResetToken=pwdResetToken;
            this._pwdResetExpires=pwdResetExpires;
        }
        #endregion
        #region Public Properties
        public virtual int PwdResetId
        {
            get {return _pwdResetId;}
            set {_pwdResetId=value;}
        }
        public virtual string PwdResetEmail
        {
            get {return _pwdResetEmail;}
            set {_pwdResetEmail=value;}
        }
        public virtual string PwdResetSelector
        {
            get {return _pwdResetSelector;}
            set {_pwdResetSelector=value;}
        }
        public virtual string PwdResetToken
        {
            get {return _pwdResetToken;}
            set {_pwdResetToken=value;}
        }
        public virtual string PwdResetExpires
        {
            get {return _pwdResetExpires;}
            set {_pwdResetExpires=value;}
        }
        #endregion
    }
    #endregion
}